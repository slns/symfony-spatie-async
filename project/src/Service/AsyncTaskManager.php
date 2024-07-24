<?php

namespace App\Service;

use App\Task\ExampleTask;
use Spatie\Async\Pool;
use Symfony\Component\Console\Output\OutputInterface;

class AsyncTaskManager
{
    public function run(int $tasksCount, OutputInterface $output): void
    {
        $pool = Pool::create();

        for ($i = 0; $i < $tasksCount; $i++) {
            $task = new ExampleTask($i);

            $pool->add($task)
                ->then(function ($result) use ($output) {
                    $output->writeln($result);
                })
                ->catch(function ($exception) use ($output) {
                    $output->writeln('Error: ' . $exception->getMessage());
                });
        }

        $pool->wait();
    }
}
