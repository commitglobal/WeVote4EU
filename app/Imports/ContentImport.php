<?php

declare(strict_types=1);

namespace App\Imports;

use Carbon\CarbonImmutable;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Events\BeforeSheet;

class ContentImport implements ToCollection, SkipsEmptyRows, WithEvents, WithHeadingRow, WithProgressBar
{
    use Importable;
    use RegistersEventListeners;

    /**
     * Key prefix.
     *
     * @var string
     */
    public string $prefix = 's';

    public ?string $sheet = null;

    public array $tree = [];

    public ?string $cursor = null;

    public array $translations = [];

    public function rules(): array
    {
        return [
            'step_code' => ['required', 'string'],
        ];
    }

    public function beforeImport(BeforeImport $event)
    {
        File::cleanDirectory(resource_path('trees'));

        File::delete(File::glob(lang_path('**/country-*.php')));
    }

    public function beforeSheet(BeforeSheet $event)
    {
        $this->sheet = $event->getSheet()->getTitle();

        $this->output->title("Importing sheet {$this->sheet}...");
    }

    public function collection(Collection $collection)
    {
        [$country, $date] = explode(' - ', $this->sheet);

        $country = Str::slug($country);

        $dates = explode('_', $date);

        $startDate = CarbonImmutable::parse($dates[0]);
        $endDate = \count($dates) > 1 ? $startDate->setDay((int) $dates[1]) : null;

        $this->tree = [
            'code' => app('countries')
                ->where('name', $country)
                ->keys()
                ->first(),
            'languages' => [],
            'dates' => [
                'start' => $startDate->toDateString(),
                'end' => $endDate?->toDateString(),
            ],
            'steps' => [],
        ];

        $collection->each(function (Collection $row) use ($country) {
            $key = (string) $row['step_code'];
            $target = $row['target'];

            unset($row['step_code'], $row['target']);

            $this->cursor = $this->prefix . $key;

            if (\array_key_exists($this->cursor, $this->tree['steps'])) {
                throw new Exception("Duplicate step code: {$key}");
            }

            if (Str::contains($key, '.')) {
                $parts = explode('.', $key);
                $this->tree['steps'][$this->prefix . $parts[0]][] = [
                    'label' => $this->cursor,
                    'target' => $this->prefix . $target,
                ];
            } else {
                $this->tree['steps'][$this->cursor] = [];
            }

            if ($target === 'other') {
                $this->tree['steps'][$this->cursor] = $this->countriesList(except: $country);
            }

            collect($row)
                ->filter()
                ->tap(function ($locales) {
                    $this->tree['languages'] = $locales->keys()->all();
                })
                ->each(function ($text, $locale) use ($country, $key) {
                    if (! $text) {
                        return;
                    }

                    $this->translations[$locale][$country][$this->prefix . $key] = Str::of($text)
                        ->markdown()
                        ->trim()
                        ->value();
                });
        });

        File::put(resource_path("trees/{$country}.json"), json_encode($this->tree, \JSON_PRETTY_PRINT));

        collect($this->translations)
            ->each(function (array $translations, string $lang) use ($country) {
                File::makeDirectory(lang_path("{$lang}"), force: true);

                if (! \array_key_exists($country, $translations)) {
                    return;
                }

                File::put(
                    lang_path("{$lang}/country-{$country}.php"),
                    $this->export($translations[$country])
                );
            });
    }

    protected function export($expression): ?string
    {
        $patterns = [
            '/array \(/' => '[',
            '/^([ ]*)\)(,?)$/m' => '$1]$2',
            '/=>[ ]?\n[ ]+\[/' => '=> [',
            '/([ ]*)(\'[^\']+\') => ([\[\'])/' => '$1$2 => $3',
        ];

        $export = preg_replace(
            array_keys($patterns),
            array_values($patterns),
            var_export($expression, true)
        );

        return "<?php\n\nreturn {$export};\n";
    }

    protected function countriesList(string $except): array
    {
        return app('countries')
            ->reject(fn (array $country, string $code) => $country['name'] === $except)
            ->map(fn (array $country, string $code) => [
                'country' => $code,
            ])
            ->values()
            ->all();
    }
}
