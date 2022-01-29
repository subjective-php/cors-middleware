<?php

namespace SubjectivePHP\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class CorsMiddleware implements MiddlewareInterface
{
    use DoublePassCompatibilityTrait;

    /**
     * @var string
     */
    private $origin;

    /**
     * @param string $origin The origin from which responses can be shared.
     */
    public function __construct(string $origin = '*')
    {
        $this->origin = $origin;
    }

    /**
     * Process an incoming server request.
     *
     * @param ServerRequestInterface  $request The incoming HTTP Request
     * @param RequestHandlerInterface $handler The request handler to which the request will be delegated.
     *
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        return $handler->handle($request)
            ->withHeader('Access-Control-Allow-Origin', $this->origin);
    }
}
