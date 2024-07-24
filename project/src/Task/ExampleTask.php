<?php

namespace App\Task;

use Spatie\Async\Task;

class ExampleTask extends Task
{
    public function __construct(private readonly int $taskId)
    {
    }

    public function configure()
    {
        // Configurações adicionais podem ser feitas aqui
    }

    public function run(): string
    {
        // Lógica da tarefa
        sleep(2); // Simula uma tarefa demorada
        return "Task {$this->taskId} completed";
    }
}
