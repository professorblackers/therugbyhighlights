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
        $response = $service->playlistItems->listPlaylistItems('snippet',
            ['playlistId' => 'UU-S6cXyil4qbIPfb2hrcH4w', 'maxResults' => 8],
        );

        $search = 'Instant Highlights';

        $this->getEmbedUrl(
            $this->getYoutubeTitleAndId($response, $search),
            $this->fixtureRepository->getFixturesNoHighlights('United Rugby Championship')
        );
    }

    public function getSuperRugbyHighlights(YouTube $service)
    {
        $response = $service->playlistItems->listPlaylistItems('snippet',
            ['playlistId' => 'UUDOGExGCsrrt_RrGDgLuMww', 'maxResults' => 8],
        );

        $search = 'Super Rugby Pacific 2024';

        $this->getEmbedUrl(
            $this->getYoutubeTitleAndId($response, $search),
            $this->fixtureRepository->getFixturesNoHighlights('Super Rugby')
        );
    }

    public function getJapanLeagueOneHighlights(YouTube $service)
    {
        $response = $service->playlistItems->listPlaylistItems('snippet',
            ['playlistId' => 'UUuIZRMChWOb0JZu7VvhlMWg', 'maxResults' => 40],
        );

        $search = '公式ハイライト';

        $this->getEmbedUrl(
            $this->getYoutubeTitleAndId($response, $search),
            $this->fixtureRepository->getFixturesNoHighlights('Japan League One')
        );
    }

    public function getYoutubeTitleAndId($response, $search): array
    {
        $videos = [];

        foreach ($response as $video) {
            if (str_contains($video->snippet->title, $search)) {
                echo $video->snippet->title . PHP_EOL;
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
                if(str_contains($video[0], $fixture['homeTeam']) || str_contains($video[0], $fixture['alternativeHomeTeam']) && str_contains($video[0], $fixture['awayTeam']) || str_contains($video[0], $fixture['alternativeAwayTeam'])) {
                    $this->fixtureRepository->update($fixture['id'], $videoString.$video[1]);
                }
            }
        }
    }
}