<?php
namespace App\XML;

use App\XML\interfaces\iXMLTypeValidator;
use App\XML\interfaces\iXMLDocument;
use App\XML\XMLTypes;

use App\XML\errors\InvalidType;

class XMLTypeValidator implements iXMLTypeValidator{

    public function validate(iXMLDocument $doc){
        $type = $doc->getType();

        if(!$type){
            throw new InvalidType("Document type is not specified.");
        }

        if( !in_array(strtolower($type), XMLTypes::Types) ){
            throw new InvalidType("Unsupported document type.");
        }

        return true;
    }

    public function validateType(iXMLDocument $doc, $type){
        $docType = $doc->getType();

        if(strtolower($docType) !== strtolower($type)){

            throw new InvalidType("The document is not of type $type.");
        }

        return true;
    }
}