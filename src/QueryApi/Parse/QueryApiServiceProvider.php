<?php
namespace QueryApi\Parse;

use Illuminate\Support\ServiceProvider;
use QueryApi\Parse\Http\RequestParamsCollection;

class QueryApiServiceServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('QueryApi\Parse\Http\RequestParamsCollection', function ($app) {
            return new RequestParamsCollection();
        });
    }
}