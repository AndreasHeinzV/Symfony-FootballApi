<?php

declare(strict_types=1);

namespace App\Components\Football;

use App\Components\Api\Business\ApiRequestFacadeInterface;

readonly class FootballBusinessFacade implements FootballBusinessFacadeInterface
{
    public function __construct(private ApiRequestFacadeInterface $apiRequestFacade)
    {
    }
    public function getLeagues(): array
    {
        return $this->apiRequestFacade->getLeagues();
    }

    public function getLeagueTeams(string $code): array
    {
        return $this->apiRequestFacade->getLeagueTeams($code);
    }

    public function getTeam(string $id): array
    {
        // TODO: Implement getTeam() method.
        return [];
    }
}