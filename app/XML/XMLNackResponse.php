<?php
namespace App\XML;
use App\XML\XMLResponseBuilder;

class XMLNackResponse extends XMLResponseBuilder{

    public function buildResponse($status, $message){

        $error_node = $this->dom->getElementsByTagName('error')->item(0);

        $code_node = $error_node->getElementsByTagName('code')->item(0);
        $code_node->nodeValue = $status;
        $message_node = $error_node->getElementsByTagName('message')->item(0);
        $message_node->nodeValue = $message;
    }
}