<?php
namespace App\Http;
use App\Http\interfaces\iXMLErrorResponse;
use \Psr\Http\Message\ResponseInterface;
use App\XML\interfaces\iXMLResponseBuilderFactory;

class XMLErrorResponse implements iXMLErrorResponse{

    private $xmlResponseFactory;

    public function __construct(iXMLResponseBuilderFactory $xmlResponseFactory){

        $this->xmlResponseFactory = $xmlResponseFactory;
    }

    public function respond(ResponseInterface $response, $statusCode, $message){

        $builder = $this->xmlResponseFactory->make('nack');
        $builder->buildResponse($statusCode, $message);

        $response->getBody()->write( $builder->getResponse() );
        return $response->withHeader('Content-type', 'text/xml')->withStatus($statusCode);
    }
}