<?php
namespace App\XML\interfaces;

interface iXMLSchemaValidator{

    public function validate(iXMLDocument $doc);
}