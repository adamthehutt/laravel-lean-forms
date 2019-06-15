<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms;

use AdamTheHutt\LeanForms\Console\FormMakeCommand;
use Illuminate\Support\ServiceProvider;

class LeanFormsServiceProvider extends ServiceProvider
{
    /**
     * Publishes configuration file.
     *
     * @return  void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands(FormMakeCommand::class);
            $this->registerPublishing();
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'lean-forms');
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/lean-forms'),
        ], 'lean-forms-views');

        $this->publishes([
            __DIR__.'/../config/lean-forms.php' => config_path('lean-forms.php'),
        ]);

        $this->mergeConfigFrom(
            __DIR__.'/../config/lean-forms.php', 'lean-forms'
        );
    }
}
