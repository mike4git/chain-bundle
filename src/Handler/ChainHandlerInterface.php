<?php declare(strict_types=1);

namespace Mike4Git\ChainBundle\Handler;

use Mike4Git\ChainBundle\Handler\Context\ChainHandlerContext;

/**
 * @template TContext of ChainHandlerContext
 */
interface ChainHandlerInterface
{
    public function supports(ChainHandlerContext $context): bool;

    /**
     * @param TContext $context
     *
     * @return TContext
     */
    public function handle(ChainHandlerContext $context): ChainHandlerContext;
}
