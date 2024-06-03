<?php

namespace App\Actions\Commands;

use Illuminate\Support\Facades\File;

class AddClassCommandAction
{
    public function __construct(
        protected string $namespace,
        protected string $className,
        protected ?string $subfolder = null
    ) {
    }

    protected function getStub(): string
    {
        $namespace = $this->namespace;

        if ($this->subfolder) {
            $namespace .= '\\' . str_replace('/', '\\', $this->subfolder);
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

    public function __invoke(): void
    {
        $path = $this->namespace;

        if ($this->subfolder) {
            $path .= '/' . $this->subfolder;

            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0755, true);
            }
        }

        $file = $path . '/' . $this->className . '.php';

        if (File::exists($file)) {
            throw new \RuntimeException($this->className . ' already exists.');
        }

        $stub = $this->getStub();
        $stub = str_replace('{{class}}', $this->className, $stub);

        File::put($file, $stub);
    }
}
