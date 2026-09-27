<?php

namespace Dobre\Widgets;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;

class DobreWidgetsServiceProvider extends ServiceProvider
{
    /**
     * Registra serviços e configurações
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/dobre-widgets.php', 'dobre-widgets');
    }

    /**
     * Bootstrap de componentes, rotas e views
     */
    public function boot()
    {
        // Carrega views do pacote
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'dobre');

        // Registro dos Blade Components com prefixo dobre-
        Blade::component('dobre::components.footer', 'dobre-footer');
        Blade::component('dobre::components.navbar', 'dobre-navbar');
        Blade::component('dobre::components.card', 'dobre-card');
        Blade::component('dobre::components.modal', 'dobre-modal');
        Blade::component('dobre::components.autocomplete', 'dobre-autocomplete');
        Blade::component('dobre::components.upload', 'dobre-upload');
        Blade::component('dobre::components.ai-chat', 'dobre-ai-chat');
        Blade::component('dobre::components.stat-card', 'dobre-stat-card');
        Blade::component('dobre::components.styles', 'dobre-styles');
        Blade::component('dobre::components.scripts', 'dobre-scripts');

        // Registro de rotas da API unificada Dobre
        $this->registerRoutes();

        // Publicação de Assets e Config
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/dobre-widgets.php' => config_path('dobre-widgets.php'),
            ], 'dobre-config');

            $this->publishes([
                __DIR__ . '/../../css' => public_path('vendor/dobre/css'),
                __DIR__ . '/../../js' => public_path('vendor/dobre/js'),
                __DIR__ . '/../../assets/brand' => public_path('vendor/dobre/brand'),
            ], 'dobre-assets');

            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/dobre'),
            ], 'dobre-views');
        }
    }

    /**
     * Registra as rotas de Autocomplete e IA
     */
    protected function registerRoutes()
    {
        $prefix = config('dobre-widgets.api.prefix', 'dobre-api');
        $middleware = config('dobre-widgets.api.middleware', ['web']);

        Route::group([
            'prefix' => $prefix,
            'middleware' => $middleware,
            'namespace' => 'Dobre\Widgets\Controllers',
        ], function () {
            Route::get('/autocomplete', [Controllers\DobreApiController::class, 'autocomplete'])->name('dobre.api.autocomplete');
            Route::get('/search/global', [Controllers\DobreApiController::class, 'globalSearch'])->name('dobre.api.search.global');
            Route::post('/ai/ask', [Controllers\DobreApiController::class, 'askAi'])->name('dobre.api.ai.ask');
        });
    }
}
