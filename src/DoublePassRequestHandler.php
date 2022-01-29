<?php

namespace SubjectivePHP\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class DoublePassRequestHandler implements RequestHandlerInterface
{
    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @var callable
     */
    private $delegate;

    /**
     * Create a new instance of DoublePassRequestHandler.
     *
     * @param ResponseInterface $response The outgoing HTTP response.
     * @param callable          $delegate The next middleware delegate.
     */
    public function __construct(ResponseInterface $response, callable $delegate)
    {
        $this->response = $response;
        $this->delegate = $delegate;
    }

    /**
     * Handles a request and produces a response.
     *
     * @param ServerRequestInterface $request The incoming HTTP request.
     *
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        return ($this->delegate)($request, $this->response);
    }

}
