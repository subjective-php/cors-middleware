<?php

namespace SubjectivePHPTest\Middleware;

use Laminas\Diactoros\Response;
use Laminas\Diactoros\ServerRequest;
use PHPUnit\Framework\TestCase;
use Psr\Http\Server\RequestHandlerInterface;
use SubjectivePHP\Middleware\CorsMiddleware;

/**
 * @coversDefaultClass \SubjectivePHP\Middleware\CorsMiddleware
 * @covers ::__construct
 */
final class CorsMiddlewareTest extends TestCase
{
    /**
     * @test
     * @covers ::process
     */
    public function process()
    {
        $request = new ServerRequest();
        $handler = $this->getMockBuilder(RequestHandlerInterface::class)->getMock();
        $handler->expects($this->once())
            ->method('handle')
            ->with($this->equalTo($request))
            ->willReturn(new Response());

        $middleware = new CorsMiddleware();
        $response = $middleware->process($request, $handler);
        $this->assertSame(
            ['Access-Control-Allow-Origin' =>  ['*']],
            $response->getHeaders()
        );
    }
}
