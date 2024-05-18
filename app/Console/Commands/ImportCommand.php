<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Imports\ContentImport;
use Illuminate\Console\Command;

class ImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import';

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
        $this->output->title('Importing content...');

        (new ContentImport)->withOutput($this->output)->import('WeVote4EU Content.xlsx');

        $this->output->success('Content imported successfully!');

        return static::SUCCESS;
    }
}
