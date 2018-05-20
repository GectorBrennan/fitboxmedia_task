<?php
declare(strict_types = 1);

namespace App\Console;

use App\Console\Commands\DeleteExpiredTokens;
use App\Integrations\Approveninja\ApproveninjaOrderHistory;
use App\Integrations\Approveninja\ApproveninjaUpdateOrderList;
use App\Integrations\Fetchr\FetchrUpdateOrderList;
use App\Integrations\Finaro\FinaroUpdateOrderList;
use App\Integrations\LoremIpsuma\LoremIpsumaUpdateOrderList;
use App\Integrations\Monsterleads\MonsterleadsUpdateOrderList;
use App\Integrations\Mountainspay\MountainspaysUpdateOrderList;
use App\Integrations\Weblab\WeblabUpdateOrderList;
use App\Integrations\Webvork\WebvorkUpdateOrderList;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Http\Middleware\Timezones;

class Kernel extends ConsoleKernel
{
    /**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
    ];

    public function bootstrap()
    {
        parent::bootstrap();


    }

    /**
     * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
    {
    }

	/**
	 * Register the Closure based commands for the application.
	 *
	 * @return void
	 */
	protected function commands()
	{
		$this->load(__DIR__ . '/Commands');

		require base_path('routes/console.php');
	}
}
