<?php
declare(strict_types=1);

namespace App\Providers;

use App\Http\GoDataContainer;
use App\Models\{
    Administrator, CashRequisite, Deposit, FlowDomain, EpaymentsRequisite, Integration, Landing, Lead, MyOffer, PaxumRequisite, Publisher, RedirectDomain, SwiftRequisite, TdsDomain, Transit, WebmoneyRequisite
};
use App\Services\Cloaking\ParserSettings;
use App\Services\PublisherApiDataContainer;
use Illuminate\Support\ServiceProvider;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use Laravel\Dusk\DuskServiceProvider;
use Sentry\SentryLaravel\SentryLaravelServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    public function register()
    {
        $env = $this->app->environment();

        if ($env === 'local') {
            $this->app->register(IdeHelperServiceProvider::class);
            $this->app->register(DuskServiceProvider::class);
        }

    }
}
