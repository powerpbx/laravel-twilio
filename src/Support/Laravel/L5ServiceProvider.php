<?php
namespace PowerPBX\Twilio\Support\Laravel;

use PowerPBX\Twilio\Commands\TwilioCallCommand;
use PowerPBX\Twilio\Commands\TwilioSmsCommand;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class L5ServiceProvider extends LaravelServiceProvider
{
    use ServiceProviderTrait;

    /**
     * Boot method.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/config.php' => config_path('twilio.php'),
        ], 'config');

        $this->mergeConfigFrom(__DIR__.'/../../config/config.php', 'twilio');

        $this->commands([
            TwilioCallCommand::class,
            TwilioSmsCommand::class,
        ]);
    }

    /**
     * @return array
     */
    protected function config()
    {
        return $this->app['config']->get('twilio.twilio');
    }
}
