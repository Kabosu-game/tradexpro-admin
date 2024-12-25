<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Spatie\ShortSchedule\ShortSchedule;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\CustomTokenDeposit::class,
        Commands\TokenDepositCommand::class,
        Commands\AdjustCustomTokenDeposit::class,
        // Commands\BotOrderCommand::class,
        // Commands\BotOrderRemoveCommand::class,
        Commands\UpdateCoinUsdRate::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $setting = settings(['cron_coin_rate_status','cron_coin_rate','cron_token_deposit_status','cron_token_deposit']);

        $coinRate = $setting['cron_coin_rate'] ?? 10;
        $tokenDiposit = $setting['cron_token_deposit'] ?? 10;

        if(isset($setting['cron_coin_rate_status']) && $setting['cron_coin_rate_status'] == STATUS_ACTIVE) {
            $schedule->command('update-coin-usd-rate')->cron('*/' . $coinRate . ' * * * *');
        }
        if(isset($setting['cron_token_deposit_status']) && $setting['cron_token_deposit_status'] == STATUS_ACTIVE) {
            $schedule->command('command:erc20token-deposit')->cron('*/' . $tokenDiposit . ' * * * *');
            $schedule->command('custom-token-deposit')->cron('*/' . $tokenDiposit . ' * * * *');
        }
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
