<?php

namespace App\Console;

use App\Models\Currency;
use App\Models\RemainderDay;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            $currencies = Currency::all();

            foreach ($currencies as $currency) {
                RemainderDay::create([
                    'cipher' => $currency->cipher,
                    'remainder' => $currency->remainder,
                    'date' => now(),
                ]);
            }
        })->dailyAt('23:58');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
