<?php declare(strict_types=1);

namespace Mike4Git\ChainBundle\Tests\Executor;

use Mike4Git\ChainBundle\Executor\ChainExecutor;
use Mike4Git\ChainBundle\Registry\ChainHandlerRegistry;
use Mike4Git\ChainBundle\Tests\Handler\Context\SampleContext;
use Mike4Git\ChainBundle\Tests\Handler\SampleHandler;
use PHPUnit\Framework\TestCase;

class ChainExecutorTest extends TestCase
{
    public function testChainExecution(): void
    {
        $registry = new ChainHandlerRegistry();
        $registry->addHandler('example', new SampleHandler(), 100);

        $executor = new ChainExecutor($registry);
        $result = $executor->execute('example', new SampleContext('handle this text'));

        $this->assertEquals('HANDLE THIS TEXT', $result->getValue());
    }
}
