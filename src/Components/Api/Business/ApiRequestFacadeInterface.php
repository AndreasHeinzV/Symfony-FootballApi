<?php

namespace App\Components\Api\Business;

interface ApiRequestFacadeInterface
{
   // public function getPlayer(string $id): ?PlayerDTO;

    public function getTeam(string $id): array;

    public function getLeagueTeams(string $code): array;

    public function getLeagues(): array;
}