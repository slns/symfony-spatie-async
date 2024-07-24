<?php

namespace App\Controller;


use App\Task\ExampleTask;
use Spatie\Async\Pool;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SpatieAsyncController extends AbstractController
{
    #[Route('/spatie/async', name: 'app_spatie_async')]
    public function index(): Response
    {
        // Criar um pool de tarefas
        $pool = Pool::create();

        // Adicionar tarefas ao pool
        for ($i = 0; $i < 5; $i++) {
            $pool[] = new ExampleTask();
        }

        // Executar as tarefas
        $results = $pool->wait();

        // Retornar os resultados
        return new Response(implode(', ', $results));
    }
}
