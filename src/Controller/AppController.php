<?php

namespace App\Controller;

use App\Repository\FixtureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

class AppController extends AbstractController
{
    #[Route('/', name: 'rugby')]
    public function index(): Response
    {
        return $this->render('index.html.twig', [
        ]);
    }

    #[Route('/rugby/fixtures/', name: 'fixtures')]
    public function getFixtures(FixtureRepository $fixtureRepository): JsonResponse
    {
        return new JsonResponse($fixtureRepository->getFixtures());
    }
}
