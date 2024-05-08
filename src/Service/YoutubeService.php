<?php

namespace App\Service;

use App\Entity\Fixture;
use App\Repository\FixtureRepository;
use Doctrine\ORM\EntityManagerInterface as EntityManager;
use Google\Client;
use Google\Service\YouTube;

class YoutubeService
{
    protected EntityManager $entityManager;
    protected FixtureRepository $fixtureRepository;
    private string $apiKey;

    public function __construct(EntityManager $entityManager, FixtureRepository $fixtureRepository, string $apiKey)
    {
        $this->entityManager = $entityManager;
        $this->fixtureRepository = $entityManager->getRepository(Fixture::class);
        $this->apiKey = $apiKey;

    }

    public function connect(): YouTube
    {
        $apiKey = $this->apiKey;

        $client = new Client();
        $client->setDeveloperKey($apiKey);
        return new YouTube($client);
    }

    public function getHighlights(string $playlistId, int $maxResults, string $search, string $league)
    {
        $service = $this->connect();

        $response = $service->playlistItems->listPlaylistItems('snippet',
            ['playlistId' => $playlistId, 'maxResults' => $maxResults],
        );

        $this->getEmbedUrl(
            $this->getYoutubeTitleAndId($response, $search),
            $this->fixtureRepository->getFixturesNoHighlights($league)
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
        $altVideoString = 'https://www.youtube.com/watch?v=';

        foreach($videos as $video) {
            foreach ($fixtures as $fixture) {
                if(
                    str_contains($video[0], $fixture['homeTeam']) && str_contains($video[0], $fixture['awayTeam']) ||
                    str_contains($video[0], $fixture['alternativeHomeTeam']) && str_contains($video[0], $fixture['alternativeAwayTeam']) ||
                    str_contains($video[0], $fixture['homeTeam']) && str_contains($video[0], $fixture['alternativeAwayTeam']) ||
                    str_contains($video[0], $fixture['alternativeHomeTeam']) && str_contains($video[0], $fixture['awayTeam'])
                ) {
                    if($fixture['league'] == 'Top 14' || $fixture['league'] == 'Pro D2') {
                        $this->fixtureRepository->update($fixture['id'], $altVideoString.$video[1]);
                    } else {
                        $this->fixtureRepository->update($fixture['id'], $videoString.$video[1]);
                    }
                }

                // Temporary -> New Super Rugby highlights have uppercase team names
                if(
                    str_contains($video[0], strtoupper($fixture['homeTeam'])) && str_contains($video[0], strtoupper($fixture['awayTeam'])) ||
                    str_contains($video[0], strtoupper($fixture['alternativeHomeTeam'])) && str_contains($video[0], strtoupper($fixture['alternativeAwayTeam'])) ||
                    str_contains($video[0], strtoupper($fixture['homeTeam'])) && str_contains($video[0], strtoupper($fixture['alternativeAwayTeam'])) ||
                    str_contains($video[0], strtoupper($fixture['alternativeHomeTeam'])) && str_contains($video[0], strtoupper($fixture['awayTeam']))
                ) {
                    if($fixture['league'] == 'Top 14' || $fixture['league'] == 'Pro D2') {
                        $this->fixtureRepository->update($fixture['id'], $altVideoString.$video[1]);
                    } else {
                        $this->fixtureRepository->update($fixture['id'], $videoString.$video[1]);
                    }
                }
            }
        }
    }
}