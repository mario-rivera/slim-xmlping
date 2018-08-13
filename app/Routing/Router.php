<?php
namespace App\Routing;

class Router{

    public function load($app){

        require_once __DIR__ . '/routes.php';
    }
}