<?php
namespace App\XML;
use App\XML\XMLResponseBuilder;

class XMLReverseResponse extends XMLResponseBuilder{

    public function buildResponse($message){
        $body_node = $this->dom->getElementsByTagName('body')->item(0);

        $string_node = $body_node->getElementsByTagName('string')->item(0);
        $string_node->nodeValue = $message;
        $reverse_node = $body_node->getElementsByTagName('reverse')->item(0);
        $reverse_node->nodeValue = strrev($message);
    }
}