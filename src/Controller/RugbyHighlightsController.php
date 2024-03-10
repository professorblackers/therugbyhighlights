<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RugbyHighlightsController extends AbstractController
{
    #[Route('/', name: 'rugbyhighlights')]
    public function index()
    {
        return $this->render('rugbyhighlights/index.html.twig', [
        ]);
    }
}