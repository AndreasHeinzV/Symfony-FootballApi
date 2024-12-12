<?php

namespace App\Components\Football\Mapper;

use App\Components\Football\DTOs\LeagueTeamsDto;

interface LeagueTeamsMapperInterface
{
    public function createLeagueTeamsDTO(array $leagueData): LeagueTeamsDto;

    public function getLeagueTeamsData(LeagueTeamsDto $leagueTeamsDTO): array;
}
