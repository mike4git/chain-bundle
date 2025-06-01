<?php declare(strict_types=1);

namespace Mike4Git\ChainBundle\Tests\Handler;

use Mike4Git\ChainBundle\Handler\ChainHandlerInterface;
use Mike4Git\ChainBundle\Handler\Context\ChainHandlerContext;

class SampleHandler implements ChainHandlerInterface
{
    public function supports(ChainHandlerContext $context): bool
    {
        return $context->getValue() && str_starts_with($context->getValue(), 'handle');
    }

    public function handle(ChainHandlerContext $context): ChainHandlerContext
    {
        $context->setValue(strtoupper($context->getValue()));
        return $context;
    }
}
