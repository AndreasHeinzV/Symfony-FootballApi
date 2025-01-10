<?php

declare(strict_types=1);

namespace App\Components\Football\Persitence\DTOs;

readonly class LeagueTeamsDto
{
    public function __construct(
        public int $position,
        public string $name,
        public string $teamId,
        public int $playedGames,
        public int $won,
        public int $draw,
        public int $lost,
        public int $points,
        public int $goalsFor,
        public int $goalsAgainst,
        public int $goalDifference,
    ) {
    }
}
