<?php

namespace App\Controller;

use App\Entity\Landing;
use App\Repository\LandingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class LandingController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly LandingRepository $landingRepository,
        private readonly CsrfTokenManagerInterface $csrfTokenManager
    )
    {
    }


    #[Route('/save-landing', name: 'save_landing', methods: ['POST'])]
    public function saveLanding(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Validate CSRF token
        if (!$this->isCsrfTokenValid('edit', $data['_token'])) {
            return new JsonResponse(['error' => 'Invalid CSRF token'], 400);
        }

        $landing = $this->landingRepository->find($data['id']) ?? new Landing();
        $landing->setTitle($data['title']);
        $landing->setContent($data['gjs-html']);
        $landing->setPath($data['path']);

        $this->entityManager->persist($landing);
        $this->entityManager->flush();

        return new JsonResponse(['id' => $landing->getId(), 'message' => 'Landing saved successfully']);
    }

    #[Route('/load-landing/{id}', name: 'load_landing', methods: ['GET'])]
    public function loadLanding($id): JsonResponse
    {
        $landing = $this->landingRepository->find($id);

        if (!$landing) {
            return new JsonResponse(['error' => 'Landing not found'], 404);
        }

        return new JsonResponse([
            'title' => $landing->getTitle(),
            'gjs-html' => $landing->getContent(),
            'path' => $landing->getPath()
        ]);
    }
}
