<?php
namespace App\XML;

use DOMDocument;
use App\XML\interfaces\iXMLDocument;
use App\XML\interfaces\iXMLRequestDocument;

class XMLDocument implements iXMLDocument, iXMLRequestDocument{

    private $dom;
    private $type = null;
    private $xsdPath;

    function __construct(){

        $this->dom = new DOMDocument();
    }

    public function load($file){

        return $this->dom->load($file, LIBXML_NOERROR);
    }

    public function loadXML($string){

        return $this->dom->loadXML($string, LIBXML_NOERROR);
    }

    public function getType(){

        if(is_null($this->type)){

            $this->type = $this->getTypeElementValue();
        }

        return $this->type;
    }

    public function validateSchema($file){

        return $this->dom->schemaValidate($file);
    }

    public function getTagValue($tag){

        $node = $this->dom->getElementsByTagName($tag)->item(0);
        return $node->nodeValue;
    }

    private function getTypeElementValue(){
        $list = $this->dom->getElementsByTagName('type');
        $node = $list->item(0);

        return ($node) ? $node->nodeValue : false;
    }
}