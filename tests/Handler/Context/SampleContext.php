<?php declare(strict_types=1);

namespace Mike4Git\ChainBundle\Tests\Handler\Context;

use Mike4Git\ChainBundle\Handler\Context\ChainHandlerContext;

class SampleContext implements ChainHandlerContext
{
    public function __construct(
        private ?string $value = null,
    ) {
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param string|null $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

}
