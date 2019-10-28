<?php

namespace Platron\Connectum\clients;

use Platron\Connectum\handbooks\HttpCodes;
use Platron\Connectum\SdkException;
use Platron\Connectum\services\BaseGetRequest;
use Platron\Connectum\services\BaseRequest;

class GetClient extends BaseClient {
    
    /**
     * @param BaseGetRequest $service
     */
    public function sendRequest(BaseRequest $service) {
        if(!$service instanceof BaseGetRequest){
            throw new SdkException('Service wait get service');
        }
                
        $params = $service->getParameters();
        $requestUrl = $this->connectionSettings->getBaseUrl().$service->getRequestUrl();
        if(!empty($params)){
            $requestUrl = $requestUrl.'?'.http_build_query($params);
        }
        
        $curl = curl_init($requestUrl);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $this->connectionSettings->connectionTimeout);
        curl_setopt($curl, CURLOPT_SSLCERT, $this->connectionSettings->certificatePath);
        curl_setopt($curl, CURLOPT_SSLKEY, $this->connectionSettings->privateKeyPath);
        curl_setopt($curl, CURLOPT_SSLKEYPASSWD, $this->connectionSettings->privateKeyPassword);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, $this->connectionSettings->login . ":" . $this->connectionSettings->password);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->getHeaders());

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($curl);
        
        if($this->logger){
            $this->logger->log(self::LOG_LEVEL, 'Login ' . $this->connectionSettings->login, ['from' => $service->getRequestUrl()]);
            $this->logger->log(self::LOG_LEVEL, 'Requested url '.$requestUrl, ['from' => $service->getRequestUrl()]);
            $this->logger->log(self::LOG_LEVEL, 'Response '.$response, ['from' => $service->getRequestUrl()]);
        }
		
		if(curl_errno($curl)){
			throw new SdkException(curl_error($curl), curl_errno($curl));
		}

		$this->httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $decodedResponse = json_decode($response);
        if(empty($decodedResponse)){
            throw new SdkException('Service error. Empty response or not json response');
        }
		
		return $decodedResponse;
    }

}
