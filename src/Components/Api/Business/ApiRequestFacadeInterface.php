<?php

namespace App\Components\Api\Business;

use App\Components\Football\Persitence\DTOs\PlayerDto;

interface ApiRequestFacadeInterface
{
    public function getTeam(string $id): array;

    public function getLeagueTeams(string $code): array;

    public function getLeagues(): array;

    public function getPlayer(string $playerId): ?PlayerDto;
}
