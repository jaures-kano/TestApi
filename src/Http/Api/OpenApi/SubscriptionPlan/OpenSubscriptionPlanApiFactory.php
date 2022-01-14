<?php

namespace App\Http\Api\OpenApi\SubscriptionPlan;


use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\Core\OpenApi\OpenApi;

/**
 * Class OpenSubscriptionPlanApiFactory
 * @package App\Http\Api\OpenApi\SubscriptionPlan
 * @author jaures kano <ruddyjaures@mail.com>
 */
class OpenSubscriptionPlanApiFactory implements OpenApiFactoryInterface
{
    private OpenApiFactoryInterface $decorated;
    private SubscribePlanPath $subscribePlanPath;
    private ActivePlanSubscriptionPath $activePlanSubscriptionPath;
    private SubscriptionHistoryPath $subscriptionHistoryPath;


    public function __construct(OpenApiFactoryInterface    $decorated,
                                SubscribePlanPath          $subscribePlanPath,
                                SubscriptionHistoryPath    $subscriptionHistoryPath,
                                ActivePlanSubscriptionPath $activePlanSubscriptionPath)
    {
        $this->decorated = $decorated;
        $this->subscribePlanPath = $subscribePlanPath;
        $this->activePlanSubscriptionPath = $activePlanSubscriptionPath;
        $this->subscriptionHistoryPath = $subscriptionHistoryPath;
    }


    public function __invoke(array $context = []): OpenApi
    {
        $openApi = ($this->decorated)($context);

        $openApi->getPaths()->addPath('/api/subscription/plan',
            $this->subscribePlanPath->subscribePath(
                'Plan subscription', 'subscription'));

        $openApi->getPaths()->addPath('/api/subscription/active',
            $this->activePlanSubscriptionPath->activePlanSubscriptionPath(
                'Plan subscription', 'active-subscription'));

        $openApi->getPaths()->addPath('/api/subscription/history',
            $this->subscriptionHistoryPath->subscriptionHistoryPath(
                'Plan subscription', 'subscription-histoty'));

        return $openApi;
    }
}