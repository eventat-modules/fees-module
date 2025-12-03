<?php

namespace Eventat\Fees\Commands;

use AhmedAliraqi\CrudGenerator\Console\Commands\Modifier;
use Illuminate\Console\Command;
use LaravelModules\ModuleGenerator\Generator;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fees:install';

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

        $this->newLine();

        $crud = app(Generator::class)->crud('fee');

        $crud->fromPath(__DIR__.'/../../stubs')
            ->toPath(base_path())
            ->appendReplacements([
                'create_fees_table' => date('Y_m_d_His') . '_create_fees_table',
            ])
            ->appendToFile(
                file: resource_path('views/layouts/sidebar.blade.php'),
                content: "@include('dashboard.fees.partials.actions.sidebar')",
                before: "@include('dashboard.settings.sidebar')",
            );

        app(Modifier::class)->permission('fee');

        app(Modifier::class)->softDeletes('fee');

        app(Modifier::class)->langGenerator('fee');

        $this->info('✅ Fees module has been installed successfully.');
    }
}
