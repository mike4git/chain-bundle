<?php declare(strict_types=1);

namespace Mike4Git\ChainBundle\Handler;

use Mike4Git\ChainBundle\Handler\Context\ChainHandlerContext;

interface ChainHandlerInterface
{
    public function supports(ChainHandlerContext $context): bool;

    public function handle(ChainHandlerContext $context): ChainHandlerContext;
}
