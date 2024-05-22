<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImportCountryNamesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:country';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $countries = app('countries');

        locales()
            ->each(function (array $config, string $lang) use ($countries) {
                $xml = simplexml_load_string(File::get("/Users/andrei/Downloads/cldr-common-45.0/common/main/{$lang}.xml"));

                File::makeDirectory(lang_path("{$lang}"), force: true);

                File::put(
                    lang_path("{$lang}/countries.php"),
                    $this->export(
                        $countries
                            ->mapWithKeys(fn (array $country, string $code) => [
                                $code => (string) $xml->xpath('/ldml/localeDisplayNames/territories/territory[@type="' . Str::upper($code) . '"]')[0],
                            ])
                            ->all()
                    )
                );
            });

        return static::SUCCESS;
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
}
