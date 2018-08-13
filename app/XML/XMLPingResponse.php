<?php
namespace App\XML;
use App\XML\XMLResponseBuilder;

class XMLPingResponse extends XMLResponseBuilder{

    public function buildResponse($message){

        $echo_node = $this->dom->getElementsByTagName('echo')->item(0);
        $echo_node->nodeValue = $message;
    }
}