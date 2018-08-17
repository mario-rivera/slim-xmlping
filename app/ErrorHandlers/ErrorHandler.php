<?php
namespace App\ErrorHandlers;

use App\Http\interfaces\iXMLErrorResponse;

class ErrorHandler{

    private $xmlErrorResponse;

    public function __construct(iXMLErrorResponse $xmlErrorResponse){

        $this->xmlErrorResponse = $xmlErrorResponse;
    }
    
    public function __invoke($request, $response, $e){
        
        return $this->xmlErrorResponse->respond($response, 500, "Something went wrong!");
    }
}