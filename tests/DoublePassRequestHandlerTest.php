<?php

namespace SubjectivePHPTest\Middleware;

use Laminas\Diactoros\Response;
use Laminas\Diactoros\ServerRequest;
use PHPUnit\Framework\TestCase;
use SubjectivePHP\Middleware\DoublePassRequestHandler;

/**
 * @coversDefaultClass \SubjectivePHP\Middleware\DoublePassRequestHandler
 * @covers ::__construct
 */
class DoublePassRequestHandlerTest extends TestCase
{
    /**
     * @test
     * @covers ::handle
     */
    public function handle()
    {
        $response = new Response();
        $next = function ($request, $response) {
            return $response;
        };

        $handler = new DoublePassRequestHandler($response, $next);
        $this->assertSame($response, $handler->handle(new ServerRequest()));
    }
}
