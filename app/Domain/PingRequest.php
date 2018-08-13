<?php
namespace App\Domain;

use App\XML\interfaces\iXMLRequestDocument;
use App\XML\interfaces\iXMLResponseBuilderFactory;

class PingRequest{

    private $requestDoc;
    private $xmlResponseFactory;

    public function __construct(
        iXMLRequestDocument $requestDoc, 
        iXMLResponseBuilderFactory $xmlResponseFactory
    ){

        $this->requestDoc = $requestDoc;
        $this->xmlResponseFactory = $xmlResponseFactory;
    }

    public function process(){
        $message = $this->requestDoc->getTagValue('echo');

        $builder = $this->xmlResponseFactory->make('ping_response');
        $builder->buildResponse($message);

        return $builder->getResponse();
    }
}