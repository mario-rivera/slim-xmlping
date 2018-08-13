<?php
namespace App\XML\interfaces;

interface iXMLDocument{
    
    public function load($file);
    public function loadXML($string);
    public function getType();
    public function validateSchema($file);
    public function getTagValue($tag);
}