<?php

namespace App\Console\Commands;

use App\Services\CurrencyValueService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class InsertTwoYears extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insertLastTwoYears';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert the last two years to DB';

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
     */
    public function handle()
    {
        $start = Carbon::now()->subYears(2);
        $end = Carbon::now();

        $sdw = new CurrencyValueService();
        $sdw->storePeriod($start, $end);

        $this->info('Last two years are now in database');

        return 1;
    }
}
