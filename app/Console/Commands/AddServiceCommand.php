<?php

namespace App\Console\Commands;

class AddServiceCommand extends AddClassCommand
{
    protected $signature = 'make:service {name}';

    protected $description = 'Add a service to the application.';

    protected function getNamespace(): string
    {
        return 'App\Services';
    }

    protected function getClassName(): string
    {
        return 'Service';
    }
}
