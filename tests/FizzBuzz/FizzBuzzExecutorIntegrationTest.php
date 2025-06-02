<?php

declare(strict_types=1);

namespace Mike4Git\ChainBundle\Tests\FizzBuzz;

use Mike4Git\ChainBundle\Executor\ChainExecutor;
use Mike4Git\ChainBundle\Tests\app\TestKernel;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class FizzBuzzExecutorIntegrationTest extends KernelTestCase
{
    public function testFizzBuzzChain(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        /** @var ChainExecutor $executor */
        $executor = $container->get(ChainExecutor::class);

        $context = new FizzBuzzContext(0, '');
        for ($number = 1; $number <= 20; ++$number) {
            $context->number = $number;
            $resultedContext = $executor->execute('fizzbuzz', $context, true);
        }

        $this->assertEquals('1 2 Fizz 4 Buzz Fizz 7 8 Fizz Buzz 11 Fizz 13 14 FizzBuzz 16 17 Fizz 19 Buzz', trim($resultedContext->result));
    }

    protected static function getKernelClass(): string
    {
        return TestKernel::class;
    }
}
