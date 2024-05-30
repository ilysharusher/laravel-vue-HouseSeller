<?php

namespace App\Console\Commands;

class AddActionCommand extends AddClassCommand
{
    protected $signature = 'make:action {name}';

    protected $description = 'Add an action to the application.';

    protected function getNamespace(): string
    {
        return 'Action';
    }
}
