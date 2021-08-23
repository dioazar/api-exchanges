<?php

namespace App\Console\Commands;

use App\Services\CurrencyValueService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class insertDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insertDaily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert data daily';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     * @throws \Throwable
     */
    public function handle()
    {
        $date = Carbon::now()->subDays(3);

        $sdw = new CurrencyValueService();
        $sdw->storePeriod($date, $date);

        $this->info('Inserted daily data');

        return 1;
    }
}
