<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class RedisTestCommand extends Command
{
    protected $signature = 'redis:test';

    protected $description = 'Command description';

    public function handle(): void
    {
        //        Cache::put('test', 'test');
    }
}
