<?php

declare(strict_types=1);

namespace App\Components\Football\Persitence\DTOs;

class LeaguesDTO
{
    public function __construct(
        public int $id,
        public string $name,
        public string $link,
    ) {
    }
}