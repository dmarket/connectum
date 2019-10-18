<?php

namespace Platron\Connectum\tests\integration;

use Platron\Connectum\clients\PostClient;
use Platron\Connectum\services\order_create\OrderCreateRequest;
use Platron\Connectum\services\order_create\OrderCreateResponse;

class OrderCreateTest extends IntegrationTestBase {
    public function testRequest(){
        $client = (new PostClient($this->connectionSettings))->setLogger($this->logger);
        $request = new OrderCreateRequest(10, 'RUB');
		$request->setCustomFields(['site' => $this->merchantSite]);

        $this->assertTrue((new OrderCreateResponse($client->sendRequest($request)))->isValid());
    }
}
