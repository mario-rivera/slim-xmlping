<?php

return [
    App\Routing\Router::class => DI\autowire(App\Routing\Router::class),
    App\XML\interfaces\iXMLValidator::class => DI\autowire(App\XML\XMLValidator::class),
    App\XML\interfaces\iXMLSchemaValidator::class => DI\autowire(App\XML\XMLSchemaValidator::class)
        ->method('setXsdPath', dirname(dirname(__DIR__)) . '/vwxml/xsds'),
    App\XML\interfaces\iXMLTypeValidator::class => DI\autowire(App\XML\XMLTypeValidator::class),
    App\XML\interfaces\iXMLResponseBuilderFactory::class => DI\autowire(App\XML\XMLResponseBuilderFactory::class)
        ->method('setXmlPath', dirname(dirname(__DIR__)) . '/vwxml/samples'),
    App\XML\interfaces\iXMLDocumentFactory::class => DI\autowire(App\XML\XMLDocumentFactory::class),
    App\Http\interfaces\iXMLErrorResponse::class => DI\autowire(App\Http\XMLErrorResponse::class)
];