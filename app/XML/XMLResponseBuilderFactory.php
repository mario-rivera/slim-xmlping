<?php
namespace App\XML;
use App\XML\interfaces\iXMLResponseBuilderFactory;

use App\XML\XMLNackResponse;
use App\XML\XMLPingResponse;
use App\XML\XMLReverseResponse;

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

        switch(strtolower($type)){

            case 'ping_response':
                return new XMLPingResponse();
            break;

            case 'reverse_response':
                return new XMLReverseResponse();
            break;

            case 'nack':
            default:
                return new XMLNackResponse();
            break;
        }
    }
}