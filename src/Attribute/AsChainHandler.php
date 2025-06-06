<?php declare(strict_types=1);

namespace Mike4Git\ChainBundle\Attribute;

#[\Attribute(\Attribute::TARGET_CLASS)]
class AsChainHandler
{
    public function __construct(
        public string $chain,
        public int $priority = 0,
        public string $description = '',
    ) {
    }
}
