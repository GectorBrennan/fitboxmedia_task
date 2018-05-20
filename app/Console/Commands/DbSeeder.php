<?php
declare(strict_types=1);

namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;

class DbSeeder extends Command
{
    protected $signature = 'db:reset';
    protected $description = '';

    public function handle()
    {

        $this->call('migrate:fresh', ['--force' => true]);
    }
}
