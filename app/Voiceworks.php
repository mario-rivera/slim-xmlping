<?php
namespace App;

use DI\Bridge\Slim\App as PHPdi;
use DI\ContainerBuilder;
use App\Routing\Router;

class Voiceworks extends PHPdi
{
    protected function configureContainer(ContainerBuilder $builder){
        
        $builder->addDefinitions(__DIR__ . '/config/definitions.php');
    }

    public function loadRoutes(){

        $router = $this->getContainer()->get(Router::class);
        $router->load($this);

        return $this;
    }
}