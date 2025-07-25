<?php declare(strict_types=1);

namespace Mike4Git\ChainBundle\Tests\FizzBuzz;

use Mike4Git\ChainBundle\Attribute\AsChainHandler;
use Mike4Git\ChainBundle\Handler\ChainHandlerInterface;
use Mike4Git\ChainBundle\Handler\Context\ChainHandlerContext;

/**
 * @implements ChainHandlerInterface<FizzBuzzContext>
 */
#[AsChainHandler(
    chain: 'fizzbuzz',
    priority: 100,
    description: 'appends \'Buzz\' to the result in case of number divisible by 5',
)]
class BuzzHandler implements ChainHandlerInterface
{
    public function supports(ChainHandlerContext $context): bool
    {
        return $context instanceof FizzBuzzContext && 0 === (int) $context->number % 5;
    }

    public function handle(ChainHandlerContext $context): ChainHandlerContext
    {
        $context->result .= ' Buzz';

        return $context;
    }
}
