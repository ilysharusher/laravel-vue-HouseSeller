<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class AddActionCommand extends Command
{
    protected $signature = 'make:action {name}';

    protected $description = 'Add an action to the application.';

    protected function getStub(string $subfolder = null): string
    {
        $namespace = 'App\Actions';

        if ($subfolder) {
            $namespace .= '\\' . str_replace('/', '\\', $subfolder);
        }

        return <<<EOT
<?php

namespace {$namespace};

class {{class}}
{
    public function __invoke()
    {
        // Add your action logic here.
    }
}

EOT;
    }

    public function handle(): void
    {
        $name = $this->argument('name');
        $path = app_path('Actions');
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
            $this->error('Action already exists!');
            return;
        }

        $stub = $this->getStub($subfolder);
        $stub = str_replace('{{class}}', $name, $stub);

        File::put($file, $stub);

        $this->info('Action created successfully.');
    }
}
