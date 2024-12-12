<?php

declare(strict_types=1);

namespace App\Components\Api\Business\Model;

use App\Components\Football\Mapper\LeaguesMapperInterface;
use App\Components\Football\Mapper\LeagueTeamsMapperInterface;
use App\Service\CacheService;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiRequester implements ApiRequesterInterface
{
    private string $apiKey;
    private CacheService $cacheService;

    public function __construct(
        string $apiKey,
        private HttpClientInterface $httpClient,
        private LeaguesMapperInterface $leaguesMapper,
        private LeagueTeamsMapperInterface $leagueTeamsMapper,
        CacheService $cacheService,
    ) {
        $this->apiKey = $apiKey;
        $this->cacheService = $cacheService;
    }

    public function apiRequest(string $url): array
    {
        $cacheKey = md5($url);

        return $this->cacheService->getOrSet($cacheKey, function () use ($url) {
            $response = $this->httpClient->request(
                'GET',
                $url,
                [
                    'headers' => [
                        'X-Auth-Token' => $this->apiKey,
                    ],
                ]
            );

            $statusCode = $response->getStatusCode();
            if (200 !== $statusCode) {
                throw new \RuntimeException("API request failed with status: $statusCode");
            }

            return $response->toArray();
        });
    }

    public function getLeagues(): array
    {
        $uri = 'https://api.football-data.org/v4/competitions/';
        $matches = $this->apiRequest($uri);
        $leaguesArray = [];

        foreach ($matches['competitions'] as $competition) {
            $leagueArray = [];
            $leagueArray['id'] = $competition['id'];
            $leagueArray['link'] = '?page=competitions&name='.$competition['code'];
            $leagueArray['name'] = $competition['name'];
            $leagueDTO = $this->leaguesMapper->createLeaguesDTO($leagueArray);

            $leaguesArray[] = $leagueDTO;
        }

        return $leaguesArray;
    }

    public function getTeam(string $id): array
    {
        // TODO: Implement getTeam() method.
        return [];
    }

    public function getLeagueTeams(string $code): array
    {
        $teams = [];
        $uri = 'https://api.football-data.org/v4/competitions/'.$code.'/standings';
        $standings = $this->apiRequest($uri);

        $teamID = $standings['standings'][0]['table'];
        foreach ($teamID as $table) {
            $team = [];
            $team['position'] = $table['position'];
            $team['name'] = $table['team']['name'];
            $team['link'] = 'page=team&id='.$table['team']['id'];
            $team['playedGames'] = $table['playedGames'];
            $team['won'] = $table['won'];
            $team['draw'] = $table['draw'];
            $team['lost'] = $table['lost'];
            $team['points'] = $table['points'];
            $team['goalsFor'] = $table['goalsFor'];
            $team['goalsAgainst'] = $table['goalsAgainst'];
            $team['goalDifference'] = $table['goalDifference'];
            $teams[] = $this->leagueTeamsMapper->createLeagueTeamsDTO($team);
        }

        return $teams;
    }
}
