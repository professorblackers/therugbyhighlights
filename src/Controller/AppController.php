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

    #[Route('/fixtures', name: 'fixtures')]
    public function fixtures(FixtureRepository $fixtureRepository): Response
    {
        return $this->render('fixtures.html.twig', [
        ]);
    }

    #[Route('/archive', name: 'archive')]
    public function archive(FixtureRepository $fixtureRepository): Response
    {
        return $this->render('archive.html.twig', [
        ]);
    }

    #[Route('/rugby/getFixtures/', name: 'getFixtures')]
    public function getFixtures(FixtureRepository $fixtureRepository): JsonResponse
    {
        return new JsonResponse($fixtureRepository->getFixtures());
    }

    #[Route('/rugby/getUpcomingFixtures/', name: 'getUpcomingFixtures')]
    public function getUpcomingFixtures(FixtureRepository $fixtureRepository): JsonResponse
    {
        return new JsonResponse($fixtureRepository->getUpcomingFixtures());
    }

    #[Route('/rugby/getPastFixtures/', name: 'getPastFixtures')]
    public function getPastFixtures(FixtureRepository $fixtureRepository): JsonResponse
    {
        return new JsonResponse($fixtureRepository->getPastFixtures(4));
    }

    #[Route('/rugby/fixtures/{value}', name: 'getFilteredFixtures')]
    public function getFilteredFixtures(FixtureRepository $fixtureRepository, string $value): JsonResponse
    {
        return new JsonResponse($fixtureRepository->getFilteredFixtures($value));
    }

    #[Route('/rugby/past/fixtures/{value}', name: 'getPastFilteredFixtures')]
    public function getPastFilteredFixtures(FixtureRepository $fixtureRepository, string $value): JsonResponse
    {
        return new JsonResponse($fixtureRepository->getPastFilteredFixtures($value, 4));
    }

    #[Route('/rugby/getLeagues/', name: 'getLeagues')]
    public function getLeagues(FixtureRepository $fixtureRepository): JsonResponse
    {
        return new JsonResponse($fixtureRepository->getLeagues());
    }

    #[Route('/rugby/getTeams/', name: 'getTeams')]
    public function getTeams(FixtureRepository $fixtureRepository): JsonResponse
    {
        return new JsonResponse($fixtureRepository->getTeams());
    }

    #[Route('/rugby/teamFixtures/{value}', name: 'getTeamFixtures')]
    public function getTeamFixtures(FixtureRepository $fixtureRepository, string $value): JsonResponse
    {
        return new JsonResponse($fixtureRepository->getTeamFixtures($value));
    }

    #[Route('/rugby/past/teamFixtures/{value}', name: 'getPastTeamFixtures')]
    public function getPastTeamFixtures(FixtureRepository $fixtureRepository, string $value): JsonResponse
    {
        return new JsonResponse($fixtureRepository->getPastTeamFixtures($value, 4));
    }
}
