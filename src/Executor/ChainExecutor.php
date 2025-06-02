<?php declare(strict_types=1);

namespace Mike4Git\ChainBundle\Executor;

use Mike4Git\ChainBundle\Handler\Context\ChainHandlerContext;
use Mike4Git\ChainBundle\Registry\ChainHandlerRegistry;

/**
 * @template TContext of ChainHandlerContext
 */
class ChainExecutor
{
    /**
     * @param ChainHandlerRegistry<TContext> $registry
     */
    public function __construct(
        private readonly ChainHandlerRegistry $registry,
    ) {
    }

    /**
     * @param TContext $context
     *
     * @return TContext
     */
    public function execute(string $chainName, ChainHandlerContext $context, bool $breakOnHandle = true): ChainHandlerContext
    {
        $handlers = $this->registry->getHandlersForChain($chainName);

        foreach ($handlers as $handler) {
            if ($handler->supports($context)) {
                $result = $handler->handle($context);
                if ($breakOnHandle) {
                    return $result;
                }
            }
        }

        return $context;
    }
}
