<?php

Class Config{



    protected static $settings = array();

    public static function get($key){
        if(isset(self::$settings[$key])){
            return self::$settings[$key];
        } else {
            return NULL;
        }
    }

    public static function set($key, $value){
        self::$settings[$key] = $value;

    }

}