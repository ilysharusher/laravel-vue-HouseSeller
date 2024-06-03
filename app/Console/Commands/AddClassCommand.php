<?php

namespace App\Console\Commands;

use App\Actions\Commands\AddClassCommandAction;
use Illuminate\Console\Command;

abstract class AddClassCommand extends Command
{
    abstract protected function getNamespace(): string;

    abstract protected function getClassName(): string;

    public function handle(): void
    {
        $name = $this->argument('name');
        $subfolder = null;

        if (preg_match('#[/\\\\]#', $name)) {
            [$subfolder, $name] = preg_split('#[/\\\\]#', $name, 2);
        }

        $namespace = $this->getNamespace();
        $className = $name;

        try {
            (new AddClassCommandAction($namespace, $className, $subfolder))->__invoke();
            $this->info($this->getClassName() . ' created successfully.');
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
