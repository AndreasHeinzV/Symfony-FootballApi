<?php

namespace App\Components\Football;

interface FootballBusinessFacadeInterface
{
    public function getLeagues(): array;

    public function getLeagueTeams(string $code): array;

    public function getTeam(string $id): array;

  //  public function getPlayer(string $id): ?PlayerDTO;
}