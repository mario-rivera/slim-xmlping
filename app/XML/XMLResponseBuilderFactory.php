<?php
namespace App\XML;
use App\XML\interfaces\iXMLResponseBuilderFactory;
use App\XML\XMLResponseTypes;

class XMLResponseBuilderFactory implements iXMLResponseBuilderFactory{

    private $xmlPath;

    public function setXmlPath($path){

        $this->xmlPath = $path;
    }

    public function make($type){

        $builder = $this->getResponseType($type);
        $builder->setXmlPath($this->xmlPath);
        $builder->setType($type);
        $builder->load();
        
        return $builder;
    }

    private function getResponseType($type){

        //default response
        $class = XMLResponseTypes::Types[XMLResponseTypes::NACK];
        if(array_key_exists($type, XMLResponseTypes::Types)){
            $class = XMLResponseTypes::Types[$type];
        }

        return new $class;
    }
}