<?php

namespace App\Command;


use App\Service\AsyncTaskManager;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:async-tasks',
    description: 'Add a short description for your command',
)]
class AsyncTasksCommand extends Command
{
    private $asyncTaskManager;

    public function __construct(AsyncTaskManager $asyncTaskManager)
    {
        $this->asyncTaskManager = $asyncTaskManager;
        parent::__construct();
    }


    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $tasksCount = (int) $input->getOption('tasks');

        $output->writeln("Starting $tasksCount asynchronous tasks...");

        // Chama o método run() da AsyncTaskManager
        $this->asyncTaskManager->run($tasksCount);

        $output->writeln('All tasks completed!');

        return Command::SUCCESS;
    }
}
