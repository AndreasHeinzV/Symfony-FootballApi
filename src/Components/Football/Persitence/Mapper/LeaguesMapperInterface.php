<?php

namespace App\Components\Football\Persitence\Mapper;

use App\Components\Football\Persitence\DTOs\LeaguesDTO;

interface LeaguesMapperInterface
{
    public function createLeaguesDto(array $leaguesData);

    public function getLeaguesData(LeaguesDTO $leaguesDto): array;

}