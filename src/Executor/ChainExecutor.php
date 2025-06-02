<?php declare(strict_types=1);

namespace Mike4Git\ChainBundle\Executor;

use Mike4Git\ChainBundle\Handler\Context\ChainHandlerContext;
use Mike4Git\ChainBundle\Registry\ChainRegistry;

/**
 * @template TContext of ChainHandlerContext
 */
class ChainExecutor
{
    /**
     * @param ChainRegistry<TContext> $registry
     */
    public function __construct(
        private ChainRegistry $registry,
    ) {
    }

    public function process(string $chainName, mixed $context, bool $breakOnHandle = true): mixed
    {
        $handlers = $this->registry->getHandlers($chainName);

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
