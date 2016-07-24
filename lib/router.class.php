<?php

Class Router{

    protected $uri;
    protected $controller;
    protected $action;
    protected $params;
    protected $route;
    protected $method_prefix;
    protected $language;


    public function getUri()
    {
        return $this->uri;
    }


    public function getController()
    {
        return $this->controller;
    }


    public function getAction()
    {
        return $this->action;
    }


    public function getParams()
    {
        return $this->params;
    }



    public function getRoute()
    {
        return $this->route;
    }


    public function getMethodPrefix()
    {
        return $this->method_prefix;
    }



    public function __construct($uri)
    {
        $this->uri = urldecode(trim($uri, '/'));

        // default

        $routes = Config::get('routes');
        $this->route = Config::get('default_route');
        if(isset($routes[$this->route])){
            $this->method_prefix = $routes[$this->route];
        } else {
            $this->method_prefix = 's';
        }


        $this->controller = Config::get('default_controller');
        $this->action = Config::get('default_action');

        $uri_parts = explode('?',$this->uri);
        $path = $uri_parts[0];

        $path_parts = explode('/',$path);

        //echo "<pre>"; var_dump($path_parts); echo "</pre>";

        if( count($path_parts)){

            if( in_array( strtolower(current($path_parts)),array_keys($routes) ) ){

                $this->route = strtolower(current($path_parts));
                if( isset($routes[$this->route])){
                    $this->method_prefix = $routes[$this->route];
                } else {
                    $this->method_prefix = '';
                }
                array_shift($path_parts);

            }

            if ( current($path_parts)){
                $this->controller = strtolower(current($path_parts));
                array_shift($path_parts);
            }

            if ( current($path_parts)){
                $this->action = strtolower(current($path_parts));
                array_shift($path_parts);
            }

            $this->params = $path_parts;
        }


    }

    public static function redirect($location){

        header("Location: {$location} ");

    }

}