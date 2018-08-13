<?php
namespace App\Domain;

use App\XML\interfaces\iXMLRequestDocument;
use App\XML\interfaces\iXMLResponseBuilderFactory;

class ReverseRequest{

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
        $string = $this->requestDoc->getTagValue('string');

        $builder = $this->xmlResponseFactory->make('reverse_response');
        $builder->buildResponse($string);

        return $builder->getResponse();
    }
}