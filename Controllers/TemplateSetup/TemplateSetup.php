<?php

namespace Controllers\TemplateSetup;

class TemplateSetup{

    private $settings;

    public function __construct($settings=null)
    {
        $this->settings = !$settings?require_once('settings.php'):$settings;
        $this->handler();
    }

    private function handler()
    {

        foreach ($this->settings["supports"] as $item)
        {
            add_theme_support( $item['title'], isset($item['options'])?$item['options']:null );
        }
        foreach ($this->settings["menu"] as $key=>$item)
        {
            add_action( 'init', fn()=>register_nav_menu($key,$item));
        }
    }
}