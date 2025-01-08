<?php

declare(strict_types=1);

namespace App\Components\UserFavorite\Business;

use App\Components\User\Persistence\UserDto;
use App\Components\UserFavorite\Persistence\UserFavoriteRepositoryInterface;
use App\Entity\Favorite;

readonly class UserFavoriteBusinessFacade
{
    public function __construct(
        private FavoriteInterface $favorite,
        private UserFavoriteRepositoryInterface $userFavoriteRepository,
    ) {
    }


        public function getFavoriteStatus(string $teamId): bool
        {
            return $this->favorite->getFavStatus($teamId);
        }

    public function getUserFavorites(int $userId): array
    {
        return $this->userFavoriteRepository->getUserFavorites($userId);
    }
}
