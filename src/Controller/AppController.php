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

    #[Route('/rugby/getFixtures/', name: 'getFixtures')]
    public function getFixtures(FixtureRepository $fixtureRepository): JsonResponse
    {
        return new JsonResponse($fixtureRepository->getFixtures());
    }

    #[Route('/fixtures', name: 'fixtures')]
    public function fixtures(FixtureRepository $fixtureRepository): Response
    {
        return $this->render('fixtures.html.twig', [
        ]);
    }

    #[Route('/rugby/getUpcomingFixtures/', name: 'getUpcomingFixtures')]
    public function getUpcomingFixtures(FixtureRepository $fixtureRepository): JsonResponse
    {
        return new JsonResponse($fixtureRepository->getUpcomingFixtures());
    }
}
