<?php
namespace App\Middleware;

use \Psr\Http\Message\ServerRequestInterface;
use \Psr\Http\Message\ResponseInterface;
use Psr\Container\ContainerInterface;

use App\XML\interfaces\iXMLSchemaValidator;
use App\XML\interfaces\iXMLRequestDocument;
use App\Http\interfaces\iXMLErrorResponse;

use App\XML\errors\InvalidSchema;
use Exception;

class ValidXMLSchema{

    private $container;
    private $schemaValidator;
    private $xmlErrorResponse;

    private $xmlDoc;

    function __construct(
        ContainerInterface $c, 
        iXMLSchemaValidator $schemaValidator,
        iXMLErrorResponse $xmlErrorResponse,
        iXMLRequestDocument $xmlDoc
    ){

        $this->container = $c;
        $this->schemaValidator = $schemaValidator;
        $this->xmlErrorResponse = $xmlErrorResponse;
        $this->xmlDoc = $xmlDoc;
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
        try{
            
            $this->schemaValidator->validate($this->xmlDoc);

        }catch(InvalidSchema $e){
            return $this->xmlErrorResponse->respond($response, 400, "The document received does not conform to the schema.");
        }catch(Exception $e){
            return $this->xmlErrorResponse->respond($response, 500, $e->getMessage());
        }

        return $next($request, $response);
    }
}