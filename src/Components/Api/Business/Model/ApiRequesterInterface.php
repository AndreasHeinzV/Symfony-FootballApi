<?php

namespace App\Components\Api\Business\Model;

interface ApiRequesterInterface
{
    public function apiRequest(string $url): array;

   // public function getPlayer(string $playerID): ?PlayerDTO;

    public function getTeam(string $id): array;

    public function getLeagueTeams(string $code): array;

    public function getLeagues(): array;
}