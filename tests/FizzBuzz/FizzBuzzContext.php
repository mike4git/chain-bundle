<?php declare(strict_types=1);

namespace Mike4Git\ChainBundle\Tests\FizzBuzz;

use Mike4Git\ChainBundle\Handler\Context\ChainHandlerContext;

class FizzBuzzContext implements ChainHandlerContext
{
    public function __construct(
        public string $number,
    ) {
    }
}
