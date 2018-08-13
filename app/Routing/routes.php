<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


$app->group('', function() use($app){

    $app->post('/ping', [App\Controllers\PingRequestController::class, 'postPing'])->add(\App\Middleware\ValidPingRequest::class);
    $app->post('/reverse', [App\Controllers\ReverseRequestController::class, 'postReverse'])->add(\App\Middleware\ValidReverseRequest::class);
})
->add(\App\Middleware\ValidXMLSchema::class)
->add(\App\Middleware\ValidXMLType::class)
->add(\App\Middleware\ValidXML::class);