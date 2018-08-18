<?php
namespace App\XML;

use App\XML\XMLNackResponse;
use App\XML\XMLPingResponse;
use App\XML\XMLReverseResponse;

class XMLResponseTypes{

    const NACK = 'nack';
    const PING_RESPONSE = 'ping_response';
    const REVERSE_RESPONSE = 'reverse_response';

    const Types = [
        self::NACK => XMLNackResponse::class,
        self::PING_RESPONSE => XMLPingResponse::class,
        self::REVERSE_RESPONSE => XMLReverseResponse::class
    ];
}