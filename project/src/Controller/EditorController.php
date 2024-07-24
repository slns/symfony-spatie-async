<?php

namespace App\Controller;

use App\Entity\Landing;
use App\Repository\LandingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EditorController extends AbstractController
{
    public function __construct(
        private readonly LandingRepository $landingRepository,
        private readonly EntityManagerInterface $entityManager
    )
    {
    }

    #[Route('/editor/new', name: 'editor_new')]
    public function new(): Response
    {
        $lastLanding = $this->entityManager->getRepository(Landing::class)->findLastId();
        $lastLanding = $lastLanding ? ($lastLanding->getId() + 1) : 1;

        $landing = new Landing();
        $landing->setTitle("New Landing $lastLanding");
        $landing->setPath("new-landing-$lastLanding");
        $landing->setCreatedAt();
        $landing->setUpdatedAt();

        $this->entityManager->persist($landing);
        $this->entityManager->flush();

        return $this->redirectToRoute('app_editor', ['id' => $landing->getId()]);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[Route('/editor/{id}', name: 'app_editor', requirements: ['id' => '\d+'])]
    public function editor(int $id): Response
    {
        $landing = $this->landingRepository->find($id);

        $landingContent = '';

        if (!$landing) {
            throw $this->createNotFoundException('Landing not found');
        }

        return $this->render('editor/editor.html.twig', [
            'csrf_token' => $this->container->get('security.csrf.token_manager')->getToken('edit'),
            'landing' => $landing,
            'landing_content' => $landingContent,
        ]);
    }


}
