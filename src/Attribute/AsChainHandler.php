<?php

namespace Mike4Git\ChainBundle\Attribute;

#[\Attribute(\Attribute::TARGET_CLASS)]
class AsChainHandler
{
        public function __construct(
            public string $chain,
            public int $priority = 0,
        )
        {
        }
}
