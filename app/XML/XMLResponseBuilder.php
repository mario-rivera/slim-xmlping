<?php
namespace App\XML;
use DOMDocument;
use App\XML\interfaces\iXMLResponse;
use Exception;

class XMLResponseBuilder implements iXMLResponse{

    protected $xmlPath;
    protected $doc;
    protected $type;
    protected $dom;

    public function __construct(){

        $this->dom = new DOMDocument();
    }

    public function setType($type){

        $this->type = strtolower($type);
    }

    public function setXmlPath($path){

        $this->xmlPath = rtrim($path, DIRECTORY_SEPARATOR);
    }

    public function getXmlPath(){

        return $this->xmlPath;
    }
    
    public function load(){

        $file = $this->getXmlPath() . DIRECTORY_SEPARATOR . $this->type . '.xml';
        if( !$this->dom->load($file, LIBXML_NOERROR) ){

            throw new Exception("Response file not found. Type: {$this->type}");
        }

        return true;
    }

    public function getResponse(){

        return $this->dom->saveXML();
    }
}