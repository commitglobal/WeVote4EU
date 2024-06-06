<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Enums\StatKey;
use App\Models\Stat;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class FetchVoteMonitorLiveDataJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 1;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = Http::acceptJson()
            ->withUserAgent(config('app.name'))
            ->withHeader('x-vote-monitor-api-key', config('services.votemonitor.apikey'))
            ->get(config('services.votemonitor.url'))
            ->throw()
            ->json();

        Stat::upsert(
            collect(StatKey::values())
                ->map(fn (string $key) => [
                    'key' => $key,
                    'value' => data_get($data, $key),
                    'updated_at' => now(),
                ])
                ->reject(fn (array $item) => blank($item['value']))
                ->values()
                ->all(),
            uniqueBy: ['key'],
            update: ['value', 'updated_at'],
        );
    }
}
