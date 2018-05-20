<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Routing\Router;
use Dingo\Api\Routing\Router as DingoRouter;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    private $router;

    protected $api_namescape = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot()
    {
        $this->router = $this->app['router'];

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @param DingoRouter $dingo_router
     */
    public function map(DingoRouter $dingo_router)
    {
        $this->mapApiRoutes($dingo_router);
    }

    /**
     * Define the "api" routes for the application.
     *
     * @param DingoRouter $router
     */
    protected function mapApiRoutes(DingoRouter $router)
    {
        $router->group([
            'version' => 'v1',
            'namespace' => $this->api_namescape,
        ], function ($router) {
            require base_path('routes/api.php');
        });
    }


}