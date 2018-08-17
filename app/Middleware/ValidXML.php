<?php
namespace App\Middleware;

use \Psr\Http\Message\ServerRequestInterface;
use \Psr\Http\Message\ResponseInterface;
use Psr\Container\ContainerInterface;

use App\XML\interfaces\iXMLValidator;
use App\XML\interfaces\iXMLDocumentFactory;
use App\XML\interfaces\iXMLRequestDocument;
use App\Http\interfaces\iXMLErrorResponse;

use App\XML\errors\InvalidDocument;
use Exception;

class ValidXML{

    private $container;
    private $xmlValidator;
    private $schemaValidator;
    private $documentFactory;
    private $xmlErrorResponse;

    function __construct(
        ContainerInterface $c, 
        iXMLValidator $xmlValidator, 
        iXMLDocumentFactory $documentFactory,
        iXMLErrorResponse $xmlErrorResponse
    ){

        $this->container = $c;
        $this->xmlValidator = $xmlValidator;
        $this->typeValidator = $typeValidator;
        $this->documentFactory = $documentFactory;
        $this->xmlErrorResponse = $xmlErrorResponse;
    }

    /**
     * Example middleware invokable class
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $next)
    {
        $xml = $request->getBody()->getContents();

        try{
            
            $this->xmlValidator->validateXML($xml);

            $xmlDoc = $this->documentFactory->make();
            $this->container->set(iXMLRequestDocument::class, $xmlDoc);
            $xmlDoc->loadXML($xml);

        }catch(InvalidDocument $e){
            return $this->xmlErrorResponse->respond($response, 400, "The document received is not valid XML.");
        }

        return $next($request, $response);
    }
}