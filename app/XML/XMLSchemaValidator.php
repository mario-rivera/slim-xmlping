<?php
namespace App\XML;

use App\XML\interfaces\iXMLSchemaValidator;
use App\XML\errors\InvalidSchema;
use App\XML\interfaces\iXMLDocument;

class XMLSchemaValidator implements iXMLSchemaValidator {

    private $xsdPath;

    public function setXsdPath($path){

        $this->xsdPath = rtrim($path, DIRECTORY_SEPARATOR);
    }

    public function validate(iXMLDocument $doc){

        $file = $this->xsdPath . DIRECTORY_SEPARATOR . strtolower($doc->getType()) . '.xsd';
        
        if(!$doc->validateSchema($file)){
            throw new InvalidSchema();
        }

        return true;
    }
}