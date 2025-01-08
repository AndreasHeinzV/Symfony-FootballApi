<?php

declare(strict_types=1);

namespace App\Components\UserFavorite\Persistence;

class FavoriteMapper
{
    public function createFavoriteDTO(array $favoriteData): FavoriteDTO
    {
        return new favoriteDTO(
            $favoriteData['teamID'],
            $favoriteData['teamName'],
            $favoriteData['crest'],
            $favoriteData['favoritePosition']
        );
    }
}