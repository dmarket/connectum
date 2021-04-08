<?php

namespace Platron\Connectum\data_objects;

class ConnectionSettingsData extends BaseDataObject {
    public $login;
    public $password;
    public $certificatePath;
    public $privateKeyPath;
    public $privateKeyPassword;
    public $connectionTimeout = 30;
    public $baseUrl;
    
    public function getBaseUrl(){
        return $this->baseUrl;
    }
}
