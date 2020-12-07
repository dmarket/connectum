<?php

namespace Platron\Connectum\data_objects;

class BrowserDetailsData extends BaseDataObject {
    public $browser_accept_header;
    public $browser_color_depth;
    public $browser_ip;
    public $browser_language;
    public $browser_screen_height;
    public $browser_screen_width;
    public $browser_timezone;
    public $browser_user_agent;
    public $browser_java_enabled;
    public $window_height;
    public $window_width;

    public function getParameters() {
        $parameters = parent::getParameters();
        if ($this->browser_java_enabled !== null) {
            $parameters['browser_java_enabled'] = $this->browser_java_enabled;
        }
        if ($this->browser_timezone !== null) {
            $parameters['browser_timezone'] = $this->browser_timezone;
        }
        return $parameters;
    }
}
