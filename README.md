Platron Connectum SDK
===============
## Install
<pre><code>composer require dmarket/connectum-sdk</pre></code>

To use SDK you need to generate pem certificate and private key. You could use this command
```
openssl pkcs12 -in login.p12 -out private.key -nocerts -nodes
openssl pkcs12 -in login.p12 -out certificate.cer -nokeys
```

## Start tests
```
composer install
```

To use tests copy tests/integration/MerchantSettingsSample.php and delete Sample substring. Than use
```
vendor/bin/phpunit tests/integration
```

## Samples

0. Set connection settings in object

```php
$connectionSettings = new Platron\Connectum\data_objects\ConnectionSettingsData();
$connectionSettings->login = 'login';
$connectionSettings->password = 'password';
$connectionSettings->certificatePath = 'path_to_cert.pem';
$connectionSettings->certificatePassword = 'certificate_password;
```

1. Auth

```php
$client = new Platron\Connectum\clients\PostClient($connectionSettings);
        
$card = new Platron\Connectum\data_objects\CardData();
$card->holder = 'test test';
$card->cvv = '123';
$card->expiration_month = '06';
$card->expiration_year = '2022';

$location = new Platron\Connectum\data_objects\LocationData();
$location->ip = '8.8.8.8';

$request = new Platron\Connectum\services\order_authorize\OrderAuthorizeRequest(10, 'RUB', '4111111111111111', $card, $location);
$response = new Platron\Connectum\services\order_authorize\OrderAuthorizeResponse($client->sendRequest($request));
```

2. Capture
```php
$client = new Platron\Connectum\clients\PutClient($connectionSettings);
$request = new Platron\Connectum\services\order_charge\OrderChargeRequest(111, 10.00);
$response = new Platron\Connectum\services\order_charge\OrderChargeResponse($client->sendRequest($request));
```

3. Order list
```php
$client = new Platron\Connectum\clients\GetClient($this->connectionSettings);
$request = new Platron\Connectum\services\order_list\OrderListRequest();

$card = new Platron\Connectum\data_objects\CardData();
$card->type = Platron\Connectum\handbooks\OrderStatus::PREPARED;
$request->setCard($card);

$response = new Platron\Connectum\services\order_list\OrderListResponse($client->sendRequest($request));
```
