<?php declare(strict_types=1);

namespace Mike4Git\ChainBundle\Tests\Command;

use Mike4Git\ChainBundle\Tests\Base\BaseKernelTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;

class ListChainsCommandTest extends BaseKernelTestCase
{
    public function testListChainsCommandOutputsRegisteredChains(): void
    {
        self::bootKernel();

        $application = new Application(self::$kernel);

        // Du kannst alternativ auch nur "list:chains" verwenden, wenn du den Namen so gesetzt hast
        $command = $application->find('mike4git:chain:list');
        $commandTester = new CommandTester($command);

        $exitCode = $commandTester->execute([]);
        $output = $commandTester->getDisplay();

        // Erfolgscode prüfen
        $this->assertSame(0, $exitCode);

        // Beispielhafte Checks – passe diese an deine Chains an!
        $this->assertStringContainsString('sample', $output);
        $this->assertStringContainsString('fizzbuzz', $output);
        $this->assertStringContainsString('Priority', $output);
        $this->assertStringContainsString('Service ID', $output);
        $this->assertStringContainsString('Handler', $output);
        $this->assertStringContainsString('Task Description', $output);
    }

    public function testListChainsCommandOutputsSingleChain(): void
    {
        self::bootKernel();

        $application = new Application(self::$kernel);

        // Du kannst alternativ auch nur "list:chains" verwenden, wenn du den Namen so gesetzt hast
        $command = $application->find('mike4git:chain:list');
        $commandTester = new CommandTester($command);

        $exitCode = $commandTester->execute(['--chain' => 'sample']);
        $output = $commandTester->getDisplay();

        // Erfolgscode prüfen
        $this->assertSame(0, $exitCode);

        // Beispielhafte Checks – passe diese an deine Chains an!
        $this->assertStringContainsString('sample', $output);
    }

    public function testListChainsCommandOutputsNothing(): void
    {
        self::bootKernel();

        $application = new Application(self::$kernel);

        // Du kannst alternativ auch nur "list:chains" verwenden, wenn du den Namen so gesetzt hast
        $command = $application->find('mike4git:chain:list');
        $commandTester = new CommandTester($command);

        $exitCode = $commandTester->execute(['--chain' => 'not_existing']);
        $output = $commandTester->getDisplay();

        // Fehlercode prüfen
        $this->assertSame(Command::FAILURE, $exitCode);
        $this->assertStringContainsString("<error>Chain 'not_existing' wurde nicht gefunden.</error>", $output);
    }
}
