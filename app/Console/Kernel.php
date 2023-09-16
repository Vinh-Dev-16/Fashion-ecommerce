<?php

namespace App\Console;


use App\Jobs\ChangeOrderStatus;
use App\Models\OrderDetail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
//         $schedule->command('inspire')->everyMinute();
        $schedule->call(function () {
            $unconfirmedOrders = OrderDetail::where('status', 2)
                ->where('time_confirm', '<=', now()->subMinute(1))
                ->get();
            foreach ($unconfirmedOrders as $orderDetail) {
                dispatch(new ChangeOrderStatus($orderDetail));
            }
        })->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
