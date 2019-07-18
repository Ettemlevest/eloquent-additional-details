<?php

namespace Ettemlevest\AdditionalDetails;

use Illuminate\Support\ServiceProvider;

class AdditionalDetailsServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPublishing();
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    protected function registerPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/additional_details.php' => base_path('config/additional_details.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../database/migrations/create_additional_detail_definitions_table.stub' => database_path(
                    sprintf('migrations/%s_create_additional_detail_definitions_table.php', date('Y_m_d_His'))
                ),
                __DIR__.'/../database/migrations/create_additional_details_table.stub' => database_path(
                    sprintf('migrations/%s_create_additional_details_table.php', date('Y_m_d_His'))
                )
            ], 'migrations');
        }
    }
}
