<?php
namespace App\XML;

use App\XML\interfaces\iXMLValidator;
use DOMDocument;

use App\XML\errors\InvalidDocument;

class XMLValidator implements iXMLValidator{

    public function validateXML($xmlString){

        $document = DOMDocument::loadXML($xmlString, LIBXML_NOERROR);
        if($document === false){

            throw new InvalidDocument();
        }

        return true;
    }
}