<?php

namespace App\Command;

use App\Services\YoutubeService;
use Doctrine\ORM\EntityManagerInterface as EntityManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class HighlightsCommand extends Command
{
    protected EntityManager $entityManager;
    protected YoutubeService $youtubeService;

    public function __construct(EntityManager $entityManager, YoutubeService $youtubeService)
    {
        $this->entityManager = $entityManager;

        $this->youtubeService = $youtubeService;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName('HighlightsCommand');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Highlights Command');

        $this->getHighlights();

        $io->success('Complete');
        return Command::SUCCESS;
    }

    public function getHighlights()
    {
        $this->youtubeService->getUnitedRugbyChampionshipHighlights(
            $this->youtubeService->connect()
        );

        $this->youtubeService->getSuperRugbyHighlights(
            $this->youtubeService->connect()
        );
    }
}