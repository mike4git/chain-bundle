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
    priority: 0,
    description: 'appends the number to the result with leading empty space',
)]
class DefaultHandler implements ChainHandlerInterface
{
    public function supports(ChainHandlerContext $context): bool
    {
        return isset($context->number) && \is_int($context->number);
    }

    public function handle(ChainHandlerContext $context): ChainHandlerContext
    {
        $context->result .= ' ' . (string) $context->number;

        return $context;
    }
}
