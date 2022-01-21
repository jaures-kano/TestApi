<?php

namespace App\Http\Api\OpenApi\Cards;


use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\Core\OpenApi\OpenApi;

/**
 * Class OpenCardApiFactory
 * @package App\Http\Api\OpenApi\Cards
 * @author jaures kano <ruddyjaures@mail.com>
 */
class OpenCardApiFactory implements OpenApiFactoryInterface
{

    private OpenApiFactoryInterface $decorated;
    private CardTransfertPath $cardTransfertPath;
    private CardListPath $cardListPath;
    private CardRequestPath $cardRequestPath;
    private CardHistoryPath $cardHistoryPath;
    private CardCheckPath $cardCheckPath;

    public function __construct(OpenApiFactoryInterface $decorated,
                                CardTransfertPath       $cardTransfertPath,
                                CardListPath            $cardListPath,
                                CardCheckPath           $cardCheckPath,
                                CardRequestPath         $cardRequestPath,
                                CardHistoryPath         $cardHistoryPath
    )
    {

        $this->decorated = $decorated;
        $this->cardTransfertPath = $cardTransfertPath;
        $this->cardListPath = $cardListPath;
        $this->cardRequestPath = $cardRequestPath;
        $this->cardHistoryPath = $cardHistoryPath;
        $this->cardCheckPath = $cardCheckPath;
    }

    public function __invoke(array $context = []): OpenApi
    {
        $openApi = ($this->decorated)($context);

        $openApi->getPaths()->addPath('/api/card/request',
            $this->cardRequestPath->cardRequest(
                'Card operation', 'card-request'));

        $openApi->getPaths()->addPath('/api/card/transaction/history',
            $this->cardHistoryPath->cardHostory(
                'Card operation', 'card-history'));

        $openApi->getPaths()->addPath('/api/card/transfert',
            $this->cardTransfertPath->cardTransfert(
                'Card operation', 'card-transfert'));

        $openApi->getPaths()->addPath('/api/card/check',
            $this->cardCheckPath->checkCard(
                'Card operation', 'card-check'));

        $openApi->getPaths()->addPath('/api/card/list',
            $this->cardListPath->cardList(
                'Card operation', 'card-list'));

        return $openApi;
    }

}