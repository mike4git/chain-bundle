<?php

declare(strict_types=1);

namespace Mike4Git\ChainBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ChainBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
