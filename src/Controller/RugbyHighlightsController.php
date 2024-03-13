<?php

namespace App\Controller;

use App\Repository\FixtureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class RugbyHighlightsController extends AbstractController
{
    #[Route('/', name: 'rugbyhighlights')]
    public function index(FixtureRepository $fixtureRepository): Response
    {
        return $this->render('rugbyhighlights/index.html.twig', [
            'fixturesToday' => $fixtureRepository->getFixturesToday(),
            'fixturesYesterday' => $fixtureRepository->getFixturesYesterday(),
            'fixturesTwoDaysAgo' => $fixtureRepository->getFixturesTwoDaysAgo()
        ]);
    }

    #[Route('/fixtures', name: 'fixtures')]
    public function fixtures(FixtureRepository $fixtureRepository): Response
    {
        return $this->render('rugbyhighlights/fixtures.html.twig', [
            'fixtures' => $fixtureRepository->getUpcomingFixtures(),
        ]);
    }
}