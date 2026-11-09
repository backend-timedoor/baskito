<?php

namespace App\Console\Commands\Ziggy;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Tighten\Ziggy\Output\Types;
use Tighten\Ziggy\Ziggy;

class TypeGenerator extends Command
{
    protected $signature = 'ziggy:type
                            {path? : Path to the generated TypeScript declaration file. Default: `resources/js/ziggy.js`.}
                            {--url=}
                            {--group=}';

    protected $description = 'Generate a TypeScript declaration file for Ziggy’s routes and configuration.';

    /**
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * @return void
     */
    public function handle()
    {
        $ziggy = new Ziggy($this->option('group'), $this->option('url') ? url($this->option('url')) : null);

        $this->makeDirectory($path = $this->getPath());

        $types = $this->getTypeClass();

        $this->files->put(
            base_path(Str::replaceLast('.js', '.d.ts', $path)),
            new $types($ziggy)
        );

        $this->info('Files generated!');
    }

    protected function makeDirectory(string $path): string
    {
        if (! $this->files->isDirectory(dirname(base_path($path)))) {
            $this->files->makeDirectory(dirname(base_path($path)), 0755, true, true);
        }

        return $path;
    }

    protected function getPath(): string
    {
        $path = $this->argument('path') ?? config('ziggy.output.path', 'resources/js/ziggy.js');

        if (! is_string($path)) {
            throw new \InvalidArgumentException('The path must be a string.');
        }

        return $path;
    }

    /**
     * @return class-string<\Tighten\Ziggy\Output\Types>
     */
    protected function getTypeClass()
    {
        $type = config('ziggy.output.types', Types::class);

        if (is_string($type) && ($type === Types::class || is_subclass_of($type, Types::class))) {
            return $type;
        }

        throw new \InvalidArgumentException(
            'The output type class must be a Tighten\Ziggy\Output\Types class or extend it.'
        );
    }
}
