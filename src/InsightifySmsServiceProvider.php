<?php

namespace NotificationChannels\InsightifySMS;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Insightify\InsightifySMS;

class InsightifySmsServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton(InsightifySMS::class, function ($app) {
            if (empty($app['config']['services.insightifysms.sender_id'])
                || empty($app['config']['services.insightifysms.api_token'])) {
                throw new \InvalidArgumentException('Missing InsightifySMS config in services');
            }

            return new InsightifySMS(
                $app['config']['services.insightifysms.api_token'],
                $app['config']['services.insightifysms.sender_id']
            );
        });
    }

    public function provides(): array
    {
        return [InsightifySMS::class];
    }
}
