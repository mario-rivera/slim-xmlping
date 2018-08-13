<?php
namespace App\Middleware;

use \Psr\Http\Message\ServerRequestInterface;
use \Psr\Http\Message\ResponseInterface;
use Psr\Container\ContainerInterface;

use App\XML\interfaces\iXMLTypeValidator;
use App\XML\interfaces\iXMLRequestDocument;
use App\Http\interfaces\iXMLErrorResponse;

use App\XML\errors\InvalidType;
use Exception;

class ValidXMLType{

    private $container;
    private $typeValidator;
    private $xmlErrorResponse;

    private $xmlDoc;

    function __construct(
        ContainerInterface $c, 
        iXMLTypeValidator $typeValidator,
        iXMLErrorResponse $xmlErrorResponse,
        iXMLRequestDocument $xmlDoc
    ){

        $this->container = $c;
        $this->typeValidator = $typeValidator;
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
            
            $this->typeValidator->validate($this->xmlDoc);

        }catch(InvalidType $e){
            return $this->xmlErrorResponse->respond($response, 422, $e->getMessage());
        }catch(Exception $e){
            return $this->xmlErrorResponse->respond($response, 500, $e->getMessage());
        }

        return $next($request, $response);
    }
}