<?php

namespace LaraZeus\Bolt\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use LaraZeus\Bolt\Concerns\CanManipulateFiles;

class ZeusExtensionCommand extends Command
{
    use CanManipulateFiles;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:zeus-extension {name : Extension Name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create custom extension for zeus bolt';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $filamentPluginFullNamespace = $this->argument('name');

        $path = config('zeus-bolt.collectors.extensions.path');
        $namespace = str_replace('\\\\', '\\', trim(config('zeus-bolt.collectors.extensions.namespace'), '\\'));
        $label = Str::headline($filamentPluginFullNamespace);

        $this->copyStubToApp('ZeusExtension', "{$path}/{$filamentPluginFullNamespace}.php", [
            'namespace' => $namespace,
            'class' => $filamentPluginFullNamespace,
            'label' => $label,
        ]);

        $this->info('zeus extension created successfully!');
    }
}
