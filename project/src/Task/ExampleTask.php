<?php

namespace App\Task;

use Spatie\Async\Task;

class ExampleTask extends Task
{
    public function configure()
    {
        // Aqui você pode configurar a tarefa, se necessário
    }

    public function run()
    {
        // Coloque a lógica da sua tarefa aqui
        // Este exemplo apenas retorna uma string após um atraso
        sleep(2);
        return 'Tarefa concluída!';
    }
}