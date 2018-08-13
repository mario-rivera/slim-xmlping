<?php
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface;

use App\Domain\ReverseRequest;

class ReverseRequestController{

    private $container;
    private $reverseRequest;

    public function __construct(
        ContainerInterface $c,
        ReverseRequest $reverseRequest
    ){

        $this->container = $c;
        $this->reverseRequest = $reverseRequest;
    }

    public function postReverse(Request $request, Response $response){
        $xml = $this->reverseRequest->process();

        $response->getBody()->write( $xml );
        return $response->withHeader('Content-type', 'text/xml');
    }
}