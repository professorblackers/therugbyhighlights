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
            'fixturesYesterday' => $fixtureRepository->getFixturesByDaysAgo(1),
            'fixturesTwoDaysAgo' => $fixtureRepository->getFixturesByDaysAgo(2),
            'fixturesThreeDaysAgo' => $fixtureRepository->getFixturesByDaysAgo(3),
            'fixturesFourDaysAgo' => $fixtureRepository->getFixturesByDaysAgo(4),
        ]);
    }

    #[Route('/fixtures', name: 'fixtures')]
    public function fixtures(FixtureRepository $fixtureRepository): Response
    {
        return $this->render('rugbyhighlights/fixtures.html.twig', [
            'fixtures' => $fixtureRepository->getUpcomingFixtures(),
        ]);
    }

    #[Route('/archive', name: 'archive')]
    public function archive(FixtureRepository $fixtureRepository): Response
    {
        return $this->render('rugbyhighlights/archive.html.twig', [
            'fixtures' => $fixtureRepository->getPastFixtures(5),
        ]);
    }

    #[Route('/admin', name: 'admin')]
    public function admin(FixtureRepository $fixtureRepository): Response
    {
        return $this->render('rugbyhighlights/admin.html.twig', [
            'fixtures' => $fixtureRepository->findAll(),
        ]);
    }
}