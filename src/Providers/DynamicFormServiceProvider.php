<?php
namespace Yeganehha\DynamicForm;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

class DynamicFormServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->callAfterResolving('blade.compiler', function (BladeCompiler $bladeCompiler) {
            $this->registerBladeExtensions($bladeCompiler);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->offerPublishing();

        $this->registerMacroHelpers();

        $this->registerCommands();

        $this->registerModelBindings();
    }

    protected function offerPublishing()
    {
        $this->publishes([
            DefineProperty::getDefaultConfigurationPath() => config_path(DefineProperty::$configFile.'.php' ),
        ], 'config');

        $this->publishes([
            DefineProperty::getDefaultMigrationPath() => $this->getMigrationFileName( DefineProperty::$defaultMigrationFileName ),
        ], 'migrations');
    }


    protected function registerMacroHelpers()
    {

    }

    protected function registerCommands()
    {
    }

    protected function registerModelBindings()
    {
    }

    protected function registerBladeExtensions($bladeCompiler)
    {

    }

    /**
     * Returns existing migration file if found, else uses the current timestamp.
     *
     * @return string
     */
    protected function getMigrationFileName($migrationFileName): string
    {
        $timestamp = date('Y_m_d_His');

        $filesystem = $this->app->make(Filesystem::class);

        return Collection::make($this->app->databasePath().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR)
            ->flatMap(function ($path) use ($filesystem, $migrationFileName) {
                return $filesystem->glob($path.'*_'.$migrationFileName);
            })
            ->push($this->app->databasePath()."/migrations/{$timestamp}_{$migrationFileName}")
            ->first();
    }
}
