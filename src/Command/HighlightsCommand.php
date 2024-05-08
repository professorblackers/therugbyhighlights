<?php

namespace App\Command;

use App\Service\YoutubeService;
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
        $this->setName('getHighlights');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title($this->getName());

        $this->getHighlights();

        $io->success('Complete');
        return Command::SUCCESS;
    }

    public function getHighlights()
    {
        $this->youtubeService->getHighlights(
            'UU-S6cXyil4qbIPfb2hrcH4w',
            10,
            'Instant Highlights',
            'United Rugby Championship'
        );

        $this->youtubeService->getHighlights(
            'UUDOGExGCsrrt_RrGDgLuMww',
            10,
            'Super Rugby Pacific 2024',
            'Super Rugby'
        );

        $this->youtubeService->getHighlights(
            'UUuIZRMChWOb0JZu7VvhlMWg',
            10,
            '公式ハイライト',
            'Japan League One'
        );

        $this->youtubeService->getHighlights(
            'UULbW1klIl3T1XCp8hHYZGMw',
            10,
            'HIGHLIGHTS',
            'Premiership Rugby'
        );

        $this->youtubeService->getHighlights(
            'UUWrD2VhZdO-_W8QDBxiXmeg',
            10,
            'TOP 14 Saison 2023 2024',
            'Top 14'
        );

        $this->youtubeService->getHighlights(
            'UUqn9RhigXvnvVUkKm5iAjxg',
            10,
            'Instant Highlights',
            'Champions Cup'
        );

        $this->youtubeService->getHighlights(
            'UUqn9RhigXvnvVUkKm5iAjxg',
            10,
            'Instant Highlights',
            'Challenge Cup'
        );

        $this->youtubeService->getHighlights(
            'UUuIZRMChWOb0JZu7VvhlMWg',
            10,
            '公式ハイライト',
            'Japan League One - Division Two'
        );

        $this->youtubeService->getHighlights(
            'UUuIZRMChWOb0JZu7VvhlMWg',
            10,
            '公式ハイライト',
            'Japan League One - Division Three'
        );

        $this->youtubeService->getHighlights(
            'UUIynwDVqRK7KTUy72_kSBhA',
            10,
            'HIGHLIGHTS',
            'Major League Rugby'
        );

        $this->youtubeService->getHighlights(
            'UUu98ro1AIOu-4wtZxDRS6Tg',
            10,
            'PRO D2 Saison 2023 2024',
            'Pro D2'
        );
    }
}