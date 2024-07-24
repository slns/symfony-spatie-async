<?php

namespace App\Controller\Admin;

use App\Entity\Landing;
use App\Form\LandingType;
use App\Repository\LandingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LandingController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly LandingRepository $landingRepository,
    )
    {
    }

    #[Route('/admin/landings', name: 'admin_landings')]
    public function index(): Response
    {
        $landings = $this->landingRepository->findAll();

        return $this->render('admin/landing/index.html.twig', [
            'landings' => $landings
        ]);
    }

    #[Route('/admin/landings/create', name: 'admin_landings_create')]
    public function create(Request $request): Response
    {
        $landing = new Landing();
        $form = $this->createForm(LandingType::class, $landing);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($landing);
            $this->entityManager->flush();

            return $this->redirectToRoute('admin_landings');
        }

        return $this->render('admin/landing/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/landings/{id}/edit', name: 'admin_landings_edit')]
    public function edit(Request $request, Landing $landing): Response
    {
        $form = $this->createForm(LandingType::class, $landing);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('admin_landings');
        }

        return $this->render('admin/landing/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
