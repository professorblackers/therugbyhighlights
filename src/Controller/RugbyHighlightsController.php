<?php

namespace App\Controller;

use App\Repository\FixtureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RugbyHighlightsController extends AbstractController
{
    #[Route('/', name: 'rugbyhighlights')]
    public function index(FixtureRepository $fixtureRepository)
    {
        return $this->render('rugbyhighlights/index.html.twig', [
            'fixtures' => $fixtureRepository->findAll(),
            'fixturesToday' => $fixtureRepository->getFixturesToday(),
            'fixturesYesterday' => $fixtureRepository->getFixturesYesterday(),
            'fixturesTwoDaysAgo' => $fixtureRepository->getFixturesTwoDaysAgo()
        ]);
    }
}