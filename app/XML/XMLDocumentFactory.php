<?php
namespace App\XML;
use App\XML\interfaces\iXMLDocumentFactory;

use App\XML\XMLDocument;

class XMLDocumentFactory implements iXMLDocumentFactory{

    public function make(){

        $doc = new XMLDocument();
        return $doc;
    }
}