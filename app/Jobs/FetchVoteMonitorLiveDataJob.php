<?php

declare(strict_types=1);

namespace App\Jobs;

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
            ->withToken(config('services.votemonitor.apikey'))
            ->get(config('services.votemonitor.url'))
            ->throw()
            ->json();

        Stat::upsert(
            collect($data)
                ->map(fn ($value, $key) => [
                    'key' => $key,
                    'value' => $value,
                    'updated_at' => now(),
                ])
                ->values()
                ->all(),
            uniqueBy: ['key'],
            update: ['value', 'updated_at'],
        );
    }
}
