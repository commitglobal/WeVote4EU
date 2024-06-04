<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Enums\Country;
use App\Models\ElectionDay;
use App\Models\Post;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class NewsFeed extends Component implements HasForms
{
    use InteractsWithForms;
    use WithPagination;

    private int $perPage = 10;

    public Collection $posts;

    public ?array $filters = [];

    public function mount(): void
    {
        $this->posts = collect();

        $this->loadPosts();

        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->columns(3)
            ->schema([
                Select::make('country')
                    ->label(__('app.newsfeed.filters.country'))
                    ->options(Country::options())
                    ->enum(Country::class)
                    ->multiple()
                    ->live(onBlur: true),

                Select::make('author')
                    ->label(__('app.newsfeed.filters.author'))
                    ->options(fn () => User::query()->pluck('name', 'id'))
                    ->multiple()
                    ->live(onBlur: true),

                Select::make('day')
                    ->label(__('app.newsfeed.filters.day'))
                    ->options(
                        fn () => ElectionDay::query()
                            ->get()
                            ->mapWithKeys(fn (ElectionDay $day) => [
                                $day->id => $day->date->toDateString(),
                            ])
                    )
                    ->multiple()
                    ->live(onBlur: true),
            ])
            ->statePath('filters');
    }

    public function render()
    {
        return view('livewire.news-feed');
    }

    private function loadPosts(bool $more = false): void
    {
        $this->query()
            ->limit($this->perPage)
            ->when($more, fn (Builder $query) => $query->offset($this->posts->count()))
            ->get()
            ->each(fn (Post $post) => $this->posts->push(
                $post->toNewsFeedItem()
            ));
    }

    public function loadMore(): void
    {
        $this->loadPosts(true);
    }

    #[Computed]
    public function total(): int
    {
        return $this->query()->count();
    }

    #[Computed]
    public function hasMore(): bool
    {
        return $this->posts->count() < $this->total;
    }

    private function query(): Builder
    {
        return Post::query()
            ->with('author.media', 'electionDay', 'media')
            ->when(data_get($this->filters, 'country'), fn (Builder $query, array $countries) => $query->whereIn('country', $countries))
            ->when(data_get($this->filters, 'author'), fn (Builder $query, array $authors) => $query->whereIn('author_id', $authors))
            ->when(data_get($this->filters, 'day'), fn (Builder $query, array $days) => $query->whereIn('election_day_id', $days))
            ->onlyPublished()
            ->orderByDesc('published_at');
    }
}
