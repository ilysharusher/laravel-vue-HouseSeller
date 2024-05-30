<?php

namespace App\Console\Commands;

class AddServiceCommand extends AddClassCommand
{
    protected $signature = 'make:service {name}';

    protected $description = 'Add a service to the application.';

    protected function getNamespace(): string
    {
        return 'Service';
    }
}
