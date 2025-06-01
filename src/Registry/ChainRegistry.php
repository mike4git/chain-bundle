<?php declare(strict_types=1);

namespace Mike4Git\ChainBundle\Registry;

use Mike4Git\ChainBundle\Handler\ChainHandlerInterface;

class ChainRegistry
{
    /** @var array<array{handler: ChainHandlerInterface, priority: int}> */
    private array $chains = [];

    public function addHandler(string $chainName, ChainHandlerInterface $handler, int $priority): void
    {
        $this->chains[$chainName][] = ['handler' => $handler, 'priority' => $priority];
    }

    /**
     * @return ChainHandlerInterface[]
     */
    public function getHandlers(string $chainName): array
    {
        /** @var array<array{handler: ChainHandlerInterface, priority: int}> $handlers */
        $handlers = $this->chains[$chainName] ?? [];
        usort($handlers, fn ($a, $b) => $b['priority'] <=> $a['priority']);

        return array_map(fn ($item) => $item['handler'], $handlers);
    }
}
