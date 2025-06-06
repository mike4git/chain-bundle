<?php

declare(strict_types=1);

// src/Command/ListChainsCommand.php

namespace Mike4Git\ChainBundle\Command;

use Mike4Git\ChainBundle\Handler\Context\ChainHandlerContext;
use Mike4Git\ChainBundle\Registry\ChainHandlerRegistry;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name: 'mike4git:chain:list', description: 'list all chains and their handlers (sorted by priority)')]
class ListChainsCommand extends Command
{
    /**
     * @param ChainHandlerRegistry<ChainHandlerContext> $registry
     */
    public function __construct(
        private readonly ChainHandlerRegistry $registry,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addOption(
                'chain',
                'c',
                InputOption::VALUE_REQUIRED,
                'Name of the chain to list (optional)'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $reflection = new \ReflectionClass($this->registry);
        $property = $reflection->getProperty('handlers');
        $property->setAccessible(true);
        /** @var array<string, array<int, array{handler: object, id: string, priority: int}>> $handlers */
        $handlers = $property->getValue($this->registry);

        if (empty($handlers)) {
            $io->warning('<comment>Keine Chains gefunden.</comment>');

            return Command::SUCCESS;
        }

        $filterName = $input->getOption('chain');

        if (null !== $filterName) {
            if (!isset($handlers[$filterName])) {
                $io->error("<error>Chain '$filterName' wurde nicht gefunden.</error>");

                return Command::FAILURE;
            }

            $io->title("Chain: $filterName");
            $io->writeln(\sprintf('<info>Number of registered Handlers: %d</info>', \count($handlers[$filterName])));
            $this->printChain($handlers[$filterName], $output);
        } else {
            foreach ($handlers as $chain => $entries) {
                $output->writeln("\n<info>Chain: $chain</info>");
                $this->printChain($entries, $output);
            }
        }

        return Command::SUCCESS;
    }

    /**
     * @param array<int, array{handler: object, id: string, priority: int}> $entries
     */
    private function printChain(array $entries, OutputInterface $output): void
    {
        usort($entries, fn ($a, $b) => $b['priority'] <=> $a['priority']);

        $table = new Table($output);
        $table
            ->setHeaders(['Priority', 'Service ID', 'Handler'])
            ->setColumnStyle(0, (new TableStyle())->setPadType(\STR_PAD_LEFT));

        foreach ($entries as $entry) {
            $table->addRow([$entry['priority'], $entry['id'], \get_class($entry['handler'])]);
        }

        $table->render();
    }
}
