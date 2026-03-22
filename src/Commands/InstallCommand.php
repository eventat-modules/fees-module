<?php

namespace Eventat\Fees\Commands;

use AhmedAliraqi\CrudGenerator\Console\Commands\Modifier;
use Illuminate\Console\Command;
use LaravelModules\ModuleGenerator\Generator;

use function Laravel\Prompts\text;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fees:install {name? : Class (Singular), e.g User, Place, Car}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install fees module';

    /**
     * Execute the console command.
     *
     * @throws \Exception
     */
    public function handle()
    {
        $this->info('⌛ Installing fees module ...');

        $name = $this->argument('name') ?? text('What is the CRUD name?', 'fee');

        $viewPath = str($name)->plural()->kebab()->toString();

        $this->newLine();

        $crud = app(Generator::class)->crud($name);

        $crud->fromPath(__DIR__.'/../../stubs')
            ->toPath(base_path())
            ->appendToFile(
                file: resource_path('views/layouts/sidebar.blade.php'),
                content: "@include('dashboard.$viewPath.partials.actions.sidebar')",
                before: "@include('dashboard.settings.sidebar')",
            )
            ->publish();

        app(Modifier::class)->permission($name);

        app(Modifier::class)->softDeletes($name);

        app(Modifier::class)->langGenerator($name);

        $this->info(
            sprintf(
                '✅ %s module has been installed successfully.',
                str($name)->plural()->snake(' ')->title()->toString()
            )
        );
    }
}
