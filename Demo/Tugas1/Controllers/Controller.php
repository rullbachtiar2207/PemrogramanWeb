<?php

namespace Controllers;

abstract class Controller
{
    protected $controllerName;
    protected $controllerMethod;

    abstract public function getAllProducts();

    public function getControllerInfo()
    {
        return [
            "controller_name" => $this->controllerName,
            "method" => $this->controllerMethod
        ];
    }
}
