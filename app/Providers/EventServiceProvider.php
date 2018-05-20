<?php
declare(strict_types=1);

namespace App\Providers;

use App\Mail\SendRegistrationEmail;
use App\Observers\Lead\DetectBrowser;
use App\Mail\SendRegeneratedUserPassword;
use App\Observers\Domain\SymlinkObserver;
use App\Observers\Domain\CreateNewServiceObserver;
use App\Observers\Target\DeleteTargetGeo;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Listeners\{
    CreateLeadStatusLog, CreateUserActivityLog, FlowRefreshShowedSitesCache, GenerateFlowGroupColor,
    InsertDataParameters, SetVisitorDataAfterSiteVisited, StatOnSiteVisited, LandingDomainsConfiguration,
    PaymentRequisiteLockAfterFirstPayment, PublisherStatisticUpdateHosts,
    SyncOfferAdvertisers, OnLeadCreated, OnLeadReverted,
    TransitDomainsConfiguration, OnLeadApproved, OnLeadCancelled, OnLeadTrashed,
    SendOrderTrackingNumberSms, SendPublisherPostback, OnLeadIntegrated, User\UserElasticIndex
};
use App\Observers\Order\FillFieldsFromInfoField;
use App\Models\{
    Domain, Lead, Order, Target
};
use App\Events\{
    Auth\Login, DomainEdited, Flow\FlowEdited, Go\SiteVisited, LandingCreated, LandingEdited,
    Offer\OfferCreated, Offer\OfferEdited, OrderTrackingNumberSet, PaymentPaid, TargetGeo\TargetGeoCreated,
    TargetGeo\TargetGeoDeleted, TargetGeo\TargetGeoEdited, TargetGeoRule\TargetGeoRuleCreated,
    TargetGeoRule\TargetGeoRuleDeleted, TargetGeoRule\TargetGeoRuleEdited, TransitCreated, TransitEdited,
    User\UserCreated, UserRegistered
};
use App\Events\Lead\{
    LeadChangedSubstatus, LeadCreated, LeadIntegrated, LeadApproved, LeadCancelled, LeadReverted, LeadTrashed
};
use App\Events\MyOfferCreated;
use App\Listeners\Auth\LogSuccessfulLogin;
use App\Listeners\OfferElasticIndex;
use App\Listeners\FlowElasticIndex;
use App\Events\DomainCreated;
use App\Listeners\DomainDetectCharset;
use App\Events\FlowGroupCreated;
use App\Events\Auth\UserPasswordRegenerated;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     */
    protected $listen = [

    ];

    /**
     * The subscriber classes to register.
     */
    protected $subscribe = [

    ];

    /**
     * Register any other events for your application.
     */
    public function boot()
    {

        parent::boot();
    }
}
