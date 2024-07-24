<?php

namespace App\Controller;

use App\Repository\LandingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RenderController extends AbstractController
{
    public function __construct(
        private readonly LandingRepository $landingRepository
    )
    {}

    #[Route('/{path}', name: 'render_landing', requirements: ["path"=>".+"])]
    public function renderLanding($path): Response
    {
        $landing = $this->landingRepository->findOneBy(['path' => $path]);

        if (!$landing) {
            throw $this->createNotFoundException('Landing not found');
        }

        return new Response($landing->getContent());
    }
}
