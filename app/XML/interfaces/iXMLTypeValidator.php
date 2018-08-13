<?php
namespace App\XML\interfaces;

use App\XML\interfaces\iXMLDocument;

interface iXMLTypeValidator{
    public function validate(iXMLDocument $document);
    public function validateType(iXMLDocument $document, $type);
}