<?php

namespace App\Services;

use App\Entity\Fixture;
use App\Repository\FixtureRepository;
use Doctrine\ORM\EntityManagerInterface as EntityManager;
use Google\Client;
use Google\Service\YouTube;

class YoutubeService
{
    protected EntityManager $entityManager;
    protected FixtureRepository $fixtureRepository;

    public function __construct(EntityManager $entityManager, FixtureRepository $fixtureRepository)
    {
        $this->entityManager = $entityManager;
        $this->fixtureRepository = $entityManager->getRepository(Fixture::class);

    }

    public function connect(): YouTube
    {
        $apiKey = 'AIzaSyDaftCw7epAupgn1DpuDHzqC_VuRMDoYiM';

        $client = new Client();
        $client->setDeveloperKey($apiKey);
        return new YouTube($client);
    }

    public function getUnitedRugbyChampionshipHighlights(YouTube $service)
    {
        $response = $service->playlistItems->listPlaylistItems(            'snippet',
            ['playlistId' => 'UU-S6cXyil4qbIPfb2hrcH4w', 'maxResults' => 20],
        );

        $search = 'Instant Highlights';

        $this->getEmbedUrl(
            $this->getYoutubeTitleAndId($response, $search),
            $this->fixtureRepository->getFixturesNoHighlights('United Rugby Championship')
        );
    }

    public function getYoutubeTitleAndId($response, $search): array
    {
        $videos = [];

        foreach ($response as $video) {
            if (str_contains($video->snippet->title, $search)) {
                $videos[] = [$video->snippet->title, $video->snippet->resourceId->videoId];
            }
        }

        return $videos;
    }

    public function getEmbedUrl($videos, $fixtures)
    {
        $videoString = 'https://www.youtube.com/embed/';

        foreach($videos as $video) {
            foreach ($fixtures as $fixture) {
                if(str_contains($video[0], $fixture['homeTeam']) && str_contains($video[0], $fixture['awayTeam'])) {
                    $this->fixtureRepository->update($fixture['id'], $videoString.$video[1]);
                }
            }
        }
    }
}