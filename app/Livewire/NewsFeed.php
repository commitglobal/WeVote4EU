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
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class NewsFeed extends Component implements HasForms
{
    use InteractsWithForms;
    use WithPagination;

    public ?array $filters = [];

    protected $listeners = [
        'reload' => 'reload',
    ];

    public function mount(): void
    {
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
                    ->lazy(),

                Select::make('author')
                    ->label(__('app.newsfeed.filters.author'))
                    ->options(
                        User::query()
                            ->pluck('name', 'id')
                    )
                    ->multiple()
                    ->lazy(),

                Select::make('day')
                    ->label(__('app.newsfeed.filters.day'))
                    ->options(
                        ElectionDay::query()
                            ->get()
                            ->mapWithKeys(fn (ElectionDay $day) => [
                                $day->id => $day->date->toDateString(),
                            ])
                    )
                    ->multiple()
                    ->lazy(),
            ])
            ->statePath('filters');
    }

    public function render()
    {
        return view('livewire.news-feed', [
            'posts' => $this->getPosts(),
        ]);
    }

    public function reload(): void
    {
        $this->reset('filters');
        $this->resetPage();
    }

    protected function getPosts(): LengthAwarePaginator
    {
        return Post::query()
            ->with('author.media', 'electionDay', 'media')
            ->when(data_get($this->filters, 'country'), fn (Builder $query, array $countries) => $query->whereIn('country', $countries))
            ->when(data_get($this->filters, 'author'), fn (Builder $query, array $authors) => $query->whereIn('author_id', $authors))
            ->when(data_get($this->filters, 'day'), fn (Builder $query, array $days) => $query->whereIn('election_day_id', $days))
            ->onlyPublished()
            ->orderByDesc('published_at')
            ->paginate();
    }
}
