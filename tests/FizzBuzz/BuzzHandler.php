<?php declare(strict_types=1);

namespace Mike4Git\ChainBundle\Tests\FizzBuzz;

use Mike4Git\ChainBundle\Attribute\AsChainHandler;
use Mike4Git\ChainBundle\Handler\ChainHandlerInterface;
use Mike4Git\ChainBundle\Handler\Context\ChainHandlerContext;

/**
 * @implements ChainHandlerInterface<FizzBuzzContext>
 */
#[AsChainHandler(chain: 'fizzbuzz', priority: 100)]
class BuzzHandler implements ChainHandlerInterface
{
    public function supports(ChainHandlerContext $context): bool
    {
        return $context instanceof FizzBuzzContext && (int)$context->number % 5 === 0;
    }

    public function handle(ChainHandlerContext $context): ChainHandlerContext
    {
        $context->result .= ' Buzz';
        return $context;
    }
}
