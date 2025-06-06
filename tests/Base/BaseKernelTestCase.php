<?php

declare(strict_types=1);

namespace Mike4Git\ChainBundle\Tests\Base;

use Mike4Git\ChainBundle\Tests\app\TestKernel;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BaseKernelTestCase extends KernelTestCase
{
    protected static function getKernelClass(): string
    {
        return TestKernel::class;
    }
}
