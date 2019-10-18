<?php

namespace Platron\Connectum\tests\integration;

use Platron\Connectum\clients\PostClient;
use Platron\Connectum\data_objects\CardData;
use Platron\Connectum\data_objects\LocationData;
use Platron\Connectum\services\order_authorize\OrderAuthorizeRequest;
use Platron\Connectum\services\order_authorize\OrderAuthorizeResponse;

class OrderAuthorizeTest extends IntegrationTestBase {
    public function testRequest(){
        $client = (new PostClient($this->connectionSettings))->setLogger($this->logger);
        
        $card = new CardData();
        $card->holder = 'test test';
        $card->cvv = '123';
        $card->expiration_month = '06';
        $card->expiration_year = '2022';
        
        $location = new LocationData();
        $location->ip = '8.8.8.8';
        
        $request = new OrderAuthorizeRequest(10, 'RUB', self::PAN_SUCCESS, $card, $location);
		$request->setCustomFields(['site' => $this->merchantSite]);

        $this->assertTrue((new OrderAuthorizeResponse($client->sendRequest($request)))->isValid());
    }
}
