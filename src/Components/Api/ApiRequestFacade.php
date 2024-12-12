<?php

declare(strict_types=1);

namespace App\Components\Api;

use App\Components\Api\Business\ApiRequestFacadeInterface;
use App\Components\Api\Business\Model\ApiRequesterInterface;

readonly class ApiRequestFacade implements ApiRequestFacadeInterface
{
    public function __construct(private ApiRequesterInterface $apiRequester)
    {
    }

    public function getTeam(string $id): array
    {
        // TODO: Implement getTeam() method.
        return [];
    }

    public function getLeagueTeams(string $code): array
    {
        return $this->apiRequester->getLeagueTeams($code);
    }

    public function getLeagues(): array
    {
        // TODO: Implement getLeagues() method.
        return $this->apiRequester->getLeagues();
    }
}
