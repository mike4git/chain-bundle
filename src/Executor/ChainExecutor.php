<?php declare(strict_types=1);

namespace Mike4Git\ChainBundle\Executor;

use Mike4Git\ChainBundle\Registry\ChainRegistry;

class ChainExecutor
{
    public function __construct(
        private ChainRegistry $registry,
    ) {
    }

    public function process(string $chainName, mixed $context, bool $breakOnHandle = true): mixed
    {
        foreach ($this->registry->getHandlers($chainName) as $handler) {
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
