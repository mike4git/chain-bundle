<?php

declare(strict_types=1);

use Mike4Git\ChainBundle\ChainBundle;

final class TestKernel extends Nyholm\BundleTest\TestKernel
{
    private ?string $testProjectDir = null;

    public function __construct(string $environment, bool $debug)
    {
        parent::__construct($environment, $debug);

        $this->addTestBundle(ChainBundle::class);
    }

    public function getProjectDir(): string
    {
        return $this->testProjectDir ?? __DIR__;
    }

    public function setTestProjectDir($projectDir): void
    {
        $this->testProjectDir = $projectDir;
    }
}
