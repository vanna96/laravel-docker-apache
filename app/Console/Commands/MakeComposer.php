<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeComposer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:composer {name : The name of the composer class}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new view composer class';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        $namespace = "App\\View\\Composers";
        $path = app_path("View/Composers/{$name}.php");

        if (File::exists($path)) {
            $this->error("Composer {$name} already exists!");
            return Command::FAILURE;
        }

        // Load the stub
        $stubPath = resource_path('stubs/composer.stub');
        if (!File::exists($stubPath)) {
            $this->error("Stub file not found at {$stubPath}");
            return Command::FAILURE;
        }

        $stub = File::get($stubPath);

        // Replace placeholders
        $stub = Str::replace(['{{ namespace }}', '{{ class }}'], [$namespace, $name], $stub);

        // Create the directory if it doesn't exist
        File::ensureDirectoryExists(dirname($path));

        // Write the file
        File::put($path, $stub);

        $this->info("Composer {$name} created successfully.");
        return Command::SUCCESS;
    }
}
