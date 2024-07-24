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
    public function __construct(private readonly AsyncTaskManager $asyncTaskManager)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Execute asynchronous tasks using Spatie\'s Async package.')
            ->addOption('tasks', null, InputOption::VALUE_REQUIRED, 'Number of async tasks to run', 5);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $tasksCount = (int) $input->getOption('tasks');

        $output->writeln("Starting $tasksCount asynchronous tasks...");

        // Chama o método run() da AsyncTaskManager
        $this->asyncTaskManager->run($tasksCount, $output);

        $output->writeln('All tasks completed!');

        return Command::SUCCESS;
    }
}
