<?php

namespace App\Components\Football\Mapper;

use App\Components\Football\DTOs\LeaguesDTO;

interface LeaguesMapperInterface
{
    public function createLeaguesDto(array $leaguesData);

    public function getLeaguesData(LeaguesDTO $leaguesDto): array;

}