<?php

namespace App\Service;

use Spatie\Async\Pool;

class AsyncTaskManager
{
    public function run(int $tasksCount)
    {
        $pool = Pool::create();

        // Adiciona tarefas ao pool
        for ($i = 1; $i <= $tasksCount; $i++) {
            $pool->add(function () use ($i) {
                // Simula uma tarefa longa
                sleep(rand(1, 3)); // Tempo aleatório entre 1 e 3 segundos
                return "Task $i completed.";
            })->then(function ($output) {
                // Imprime o resultado da tarefa
                echo "$output\n";
            });
        }

        // Aguarda a conclusão de todas as tarefas
        $pool->wait();
    }
}