<?php
namespace App\XML;

class XMLTypes{

    const PING_REQUEST = 'ping_request';
    const REVERSE_REQUEST = 'reverse_request';

    const Types = [
        self::PING_REQUEST,
        self::REVERSE_REQUEST
    ];
}