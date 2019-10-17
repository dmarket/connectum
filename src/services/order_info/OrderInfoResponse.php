<?php

namespace Platron\Connectum\services\order_info;

use Platron\Connectum\data_objects\Form3dData;
use Platron\Connectum\services\BaseResponse;
use Platron\Connectum\data_objects\CardData;
use Platron\Connectum\data_objects\ClientData;
use Platron\Connectum\data_objects\IssuerData;
use Platron\Connectum\data_objects\LocationData;
use Platron\Connectum\data_objects\Secure3dData;
use Platron\Connectum\data_objects\OperationData;
use stdClass;

class OrderInfoResponse extends BaseResponse {
    
    public $amount;
    public $amount_charged;
    public $amount_refunded;
    public $auth_code;
    public $created;
    public $currency;
    public $description;
    public $descriptor;
    public $id;
    public $merchant_order_id;
    public $pan;
    public $status;
    public $updated;
    public $form3d_html;
    public $custom_fields;
    
    /** @var CardData */
    public $card;
    /** @var ClientData */
    public $client;
    /** @var IssuerData */
    public $issuer;
    /** @var LocationData */
    public $location;
    /** @var Secure3dData */
    public $secure3d;
    /** @var OperationData[] */
    public $operations;
    /** @var Form3dData */
    public $form3d;
    
    /**
     * {@inheritdoc}
     */
    public function __construct(stdClass $response) {
        parent::__construct($response);
        if(!empty($response->orders[0])){
            parent::__construct($response->orders[0]);
        }
    }
}
