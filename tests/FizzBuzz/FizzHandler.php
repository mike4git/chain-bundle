<?php declare(strict_types=1);

namespace Mike4Git\ChainBundle\Tests\FizzBuzz;

use Mike4Git\ChainBundle\Handler\ChainHandlerInterface;
use Mike4Git\ChainBundle\Handler\Context\ChainHandlerContext;

class FizzHandler implements ChainHandlerInterface
{
    public function supports(ChainHandlerContext $context): bool
    {
        return isset($context->number) && (0 === $context->number % 3);
    }

    public function handle(ChainHandlerContext $context): ChainHandlerContext
    {
        $context->number = 'Fizz';

        return $context;
    }
}
