<?php declare(strict_types=1);

namespace Mike4Git\ChainBundle\Tests\FizzBuzz;

use Mike4Git\ChainBundle\Handler\ChainHandlerInterface;
use Mike4Git\ChainBundle\Handler\Context\ChainHandlerContext;

class FizzBuzzHandler implements ChainHandlerInterface
{
    public function supports(ChainHandlerContext $context): bool
    {
        return $context instanceof FizzBuzzContext && 0 === (int)$context->number % 15;
    }

    public function handle(ChainHandlerContext $context): ChainHandlerContext
    {
        $context->result .= ' FizzBuzz';
        return $context;
    }
}
