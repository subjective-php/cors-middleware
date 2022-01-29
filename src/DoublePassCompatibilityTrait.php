<?php

namespace SubjectivePHP\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

trait DoublePassCompatibilityTrait
{
    /**
     * Execute this middleware as a function.
     *
     * @param  ServerRequestInterface $request  The PSR7 request.
     * @param  ResponseInterface      $response The PSR7 response.
     * @param  callable               $next     The Next middleware.
     *
     * @return ResponseInterface
     */
    final public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        $handler = new DoublePassRequestHandler($response, $next);
        return $this->process($request, $handler);
    }

    /**
     * Process an incoming server request.
     *
     * @param ServerRequestInterface  $request The incoming HTTP Request
     * @param RequestHandlerInterface $handler The request handler to which the request will be delegated.
     *
     * @return ResponseInterface
     */
    abstract public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ) : ResponseInterface;
}
