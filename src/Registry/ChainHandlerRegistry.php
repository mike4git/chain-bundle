<?php declare(strict_types=1);

namespace Mike4Git\ChainBundle\Registry;

use Mike4Git\ChainBundle\Handler\ChainHandlerInterface;
use Mike4Git\ChainBundle\Handler\Context\ChainHandlerContext;

/**
 * @template TContext of ChainHandlerContext
 */
class ChainHandlerRegistry
{
    /**
     * @var array<string, array<int, array{priority: int, handler: ChainHandlerInterface<TContext>}>>
     */
    private array $handlers = [];

    /**
     * @param ChainHandlerInterface<TContext> $handler
     */
    public function addHandler(
        string $chainName,
        ChainHandlerInterface $handler,
        int $priority,
        ?string $serviceId = null,
        ?string $description = null,
    ): void {
        $this->handlers[$chainName][] = [
            'priority' => $priority,
            'handler' => $handler,
            'id' => $serviceId,
            'description' => $description,
        ];
    }

    /**
     * @return ChainHandlerInterface<TContext>[]
     */
    public function getHandlersForChain(string $chainName): array
    {
        if (!isset($this->handlers[$chainName])) {
            return [];
        }

        usort($this->handlers[$chainName], fn ($a, $b) => $b['priority'] <=> $a['priority']);

        return array_column($this->handlers[$chainName], 'handler');
    }
}
