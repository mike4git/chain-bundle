<?php declare(strict_types=1);

namespace Mike4Git\ChainBundle\Tests\Handler;

use Mike4Git\ChainBundle\Attribute\AsChainHandler;
use Mike4Git\ChainBundle\Handler\ChainHandlerInterface;
use Mike4Git\ChainBundle\Handler\Context\ChainHandlerContext;
use Mike4Git\ChainBundle\Tests\Handler\Context\SampleContext;

/**
 * @extends ChainHandlerInterface<SampleContext>
 */
#[AsChainHandler(chain: 'sample', priority: 100)]
class SampleHandler implements ChainHandlerInterface
{
    /**
     * @param SampleContext $context
     */
    public function supports(ChainHandlerContext $context): bool
    {
        return $context instanceof SampleContext && str_starts_with($context->getValue(), 'handle');
    }

    /**
     * @param SampleContext $context
     */
    public function handle(ChainHandlerContext $context): ChainHandlerContext
    {
        $context->setValue(strtoupper($context->getValue()));

        return $context;
    }

    public function describeTask(): string
    {
        return 'turns string into uppercase STRING';
    }
}
