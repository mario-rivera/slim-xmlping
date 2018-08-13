<?php
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface;

use App\Domain\PingRequest;

class PingRequestController{

    private $container;
    private $pingRequest;

    public function __construct(
        ContainerInterface $c,
        PingRequest $pingRequest
    ){

        $this->container = $c;
        $this->pingRequest = $pingRequest;
    }

    public function postPing(Request $request, Response $response){
        $xml = $this->pingRequest->process();

        $response->getBody()->write( $xml );
        return $response->withHeader('Content-type', 'text/xml');
    }
}