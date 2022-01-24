<?php

namespace Deviar\LaravelQueryFilter\Commands;

use Deviar\LaravelQueryFilter\Generator\FileManager;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputArgument;

class MakeFilterCommand extends Command
{
    use FileManager;

    private Filesystem $filesystem;

    protected $signature = 'make:filter {filter}';

    protected $description = 'This command generates a filter class';

    private string $type = 'DummyFilters';

    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();

        $this->filesystem = $filesystem;
    }

    public function handle(): int
    {
        $filter = ucfirst($this->argument('filter'));

        if (! file_exists(app_path('/Filters'))) {
            $this->filesystem->makeDirectory(app_path('/Filters'));
        }

        $stub = $this->getStub($this->type);

        file_put_contents(app_path("Filters/{$filter}.php"), $this->replaceClass($stub, $filter));

        $this->info("Filter created successfully.");

        return 0;
    }

    protected function getArguments(): array
    {
        return ['name', InputArgument::REQUIRED, 'Filter name'];
    }

    private function replaceClass(string $stub, string $name): string
    {
        return str_replace($this->type, $name, $stub);
    }
}
