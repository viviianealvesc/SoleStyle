<?php

namespace App\Console\Commands;

use App\Models\Cupom;
use Illuminate\Console\Command;
use Carbon\Carbon;

class ExpireCoupons extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:expire-cupom';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Cupom::whereDate('expiry_date', '<', Carbon::now())->delete();

        $this->info('Expired coupons have been deleted successfully.');
    }
}
