<?php

namespace SubjectivePHPTest\Middleware;

use Laminas\Diactoros\Response;
use Laminas\Diactoros\ServerRequest;
use PHPUnit\Framework\TestCase;
use SubjectivePHP\Middleware\DoublePassCompatibilityTrait;
use SubjectivePHP\Middleware\DoublePassRequestHandler;

/**
 * @coversDefaultClass SubjectivePHP\Middleware\DoublePassCompatibilityTrait
 */
final class DoublePassCompatibilityTraitTest extends TestCase
{
    /**
     * @test
     * @covers ::__invoke
     */
    public function invoke()
    {
        $request = new ServerRequest();
        $response = new Response();
        $next = function ($request, $response) {
            return $response;
        };

        $mock = $this->getMockForTrait(DoublePassCompatibilityTrait::class);
        $mock->expects($this->once())->method('process')->with(
            $this->equalTo($request),
            $this->isInstanceOf(DoublePassRequestHandler::class)
        )->willReturn($response);

        $this->assertSame($response, ($mock)($request, $response, $next));
    }
}
