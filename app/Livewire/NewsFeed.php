<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Enums\Country;
use App\Models\Author;
use App\Models\ElectionDay;
use App\Models\Post;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class NewsFeed extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
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

    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                Select::make('country')
                    ->label(__('app.newsfeed.filters.country'))
                    ->options(Country::options())
                    ->enum(Country::class)
                    ->multiple()
                    ->lazy(),

                Select::make('author')
                    ->label(__('app.newsfeed.filters.author'))
                    ->options(
                        Author::query()
                            ->whereHas('posts')
                            ->pluck('name', 'id')
                    )
                    ->multiple()
                    ->lazy(),

                Select::make('day')
                    ->label(__('app.newsfeed.filters.day'))
                    ->options(
                        ElectionDay::query()
                            ->whereHas('posts')
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

    public function reload(): void
    {
        $this->reset('filters');
        $this->resetPage();
        $this->dispatch('$refresh');
    }

    #[Computed]
    protected function posts(): LengthAwarePaginator
    {
        return Post::query()
            ->with('author', 'electionDay', 'media')
            ->when(data_get($this->filters, 'country'), fn (Builder $query, array $countries) => $query->whereIn('country', $countries))
            ->when(data_get($this->filters, 'author'), fn (Builder $query, array $authors) => $query->whereIn('author_id', $authors))
            ->when(data_get($this->filters, 'day'), fn (Builder $query, array $days) => $query->whereIn('election_day_id', $days))
            ->onlyPublished()
            ->orderByDesc('published_at')
            ->paginate();
    }
}
