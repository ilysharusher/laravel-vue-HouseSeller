<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

abstract class AddClassCommand extends Command
{
    abstract protected function getNamespace(): string;

    protected function getStub(string $subfolder = null): string
    {
        $namespace = $this->getNamespace();

        if ($subfolder) {
            $namespace .= '\\' . str_replace('/', '\\', $subfolder);
        }

        return <<<EOT
<?php

namespace {$namespace};

class {{class}}
{
    //
}

EOT;
    }

    public function handle(): void
    {
        $name = $this->argument('name');
        $path = app_path($this->getNamespace()) . 's';
        $subfolder = null;

        if (preg_match('#[/\\\\]#', $name)) {
            [$subfolder, $name] = preg_split('#[/\\\\]#', $name, 2);
            $path .= '/' . $subfolder;

            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0755, true);
            }
        }

        $file = $path . '/' . $name . '.php';

        if (File::exists($file)) {
            $this->error($this->getNamespace() . ' already exists!');
            return;
        }

        $stub = $this->getStub($subfolder);
        $stub = str_replace('{{class}}', $name, $stub);

        File::put($file, $stub);

        $this->info($this->getNamespace() . ' created successfully.');
    }
}
