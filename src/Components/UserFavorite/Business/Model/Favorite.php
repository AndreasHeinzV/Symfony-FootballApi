<?php

declare(strict_types=1);

namespace App\Components\UserFavorite\Business\Model;

use App\Components\Football\Business\FootballBusinessFacadeInterface;
use App\Components\User\Business\UserBusinessFacadeInterface;
use App\Components\UserFavorite\Persistence\FavoriteMapper;
use App\Components\UserFavorite\Persistence\UserFavoriteEntityManagerInterface;
use App\Components\UserFavorite\Persistence\UserFavoriteRepositoryInterface;
use App\Entity\User;
use Symfony\Bundle\SecurityBundle\Security;

readonly class Favorite
{
    public function __construct(
        private FootballBusinessFacadeInterface $footballBusinessFacade,
        private UserFavoriteEntityManagerInterface $userFavoriteEntityManager,
        private UserFavoriteRepositoryInterface $userFavoriteRepository,
        private FavoriteMapper $favoriteMapper,
        private Security $security,
        private UserBusinessFacadeInterface $userBusinessFacade,
    ) {
    }

    public function manageFav(array $input): void
    {
        foreach ($input as $keyValue => $value) {
            switch (true) {
                case 'add' === $keyValue:
                    $this->handleAdd($value);
                    break;
                case 'delete' === $keyValue:
                    $this->handleRemove($value);
                    break;

                case 'up' === $keyValue:
                    $this->userFavoriteUp((int)$value);
                    break;

                case 'down' === $keyValue:
                    $this->userFavoriteDown((int)$value);
                    break;
            }
        }
    }

    public function handleRemove(string $teamId): void
    {
        $user = $this->userBusinessFacade->getUserEntity($this->security->getUser());

        if ($user instanceof User) {
            $this->userFavoriteEntityManager->deleteUserFavorite($user, $teamId);
        }
    }

    public function handleAdd(string $teamId): void
    {
        $user = $this->userBusinessFacade->getUserEntity($this->security->getUser());
        if ($user instanceof User) {
            $team = $this->footballBusinessFacade->getTeam($teamId);
            $position = $this->calculatePosition($user);
            if (!empty($team) && !$this->getFavStatus($teamId)) {
                $team['favoritePosition'] = $position;
                $this->userFavoriteEntityManager->saveUserFavorite(
                    $user,
                    $this->favoriteMapper->createFavoriteDTO($team)
                );
            }
        }
    }

    public function calculatePosition(User $user): int
    {
        $lastPosition = $this->userFavoriteRepository->getUserFavoritesLastPosition($user->getId());
        if (false === $lastPosition) {
            return 1;
        }

        return $lastPosition + 1;
    }

    public function getFavStatus(string $teamId): bool
    {
        $user = $this->userBusinessFacade->getUserEntity($this->security->getUser());
        if ($user instanceof User) {
            $favoriteEntity =  $this->userFavoriteRepository->getUserFavoriteByTeamId($user, (int)$teamId);
            return $favoriteEntity instanceof Favorite;
        }

        return false;
    }

    private function userFavoriteUp(int $teamId): void
    {
        $user = $this->userBusinessFacade->getUserEntity($this->security->getUser());

        $userFavoriteEntity = $this->userFavoriteRepository->getUserFavoriteByTeamId($user->getId(), $teamId);

        if ($userFavoriteEntity instanceof Favorite) {
            $favoritePosition = $userFavoriteEntity->;
            $firstPosition = $this->userFavoriteRepository->getUserFavoritesFirstPosition($userDTO);

            if (false !== $firstPosition && $firstPosition < $favoritePosition) {
                $positionToChange = $this->userFavoriteRepository->getFavoritePositionAboveCurrentPosition(
                    $userDTO,
                    $favoritePosition
                );
                $positionEntityToChange = $this->userFavoriteRepository->getUserFavoriteEntityByPosition(
                    $userDTO,
                    $positionToChange
                );

                $this->userFavoriteEntityManager->updateUserFavoritePosition(
                    $userFavoriteEntity,
                    $positionEntityToChange,
                    $favoritePosition,
                    $positionToChange
                );
            }
        }
    }

    private function userFavoriteDown(int $teamId): void
    {
        $userDTO = $this->sessionHandler->getUserDTO();
        $userFavoriteEntity = $this->userFavoriteRepository->getUserFavoriteByTeamId($userDTO, $teamId);

        if ($userFavoriteEntity instanceof FavoriteEntity) {
            $favoritePosition = $userFavoriteEntity->getFavoritePosition();
            $lastPosition = $this->userFavoriteRepository->getUserFavoritesLastPosition($userDTO);

            if (false !== $lastPosition && $lastPosition > $favoritePosition) {
                $positionToChange = $this->userFavoriteRepository->getFavoritePositionBelowCurrentPosition(
                    $userDTO,
                    $favoritePosition
                );
                $positionEntityToChange = $this->userFavoriteRepository->getUserFavoriteEntityByPosition(
                    $userDTO,
                    $positionToChange
                );

                $this->userFavoriteEntityManager->updateUserFavoritePosition(
                    $userFavoriteEntity,
                    $positionEntityToChange,
                    $favoritePosition,
                    $positionToChange
                );
            }
        }
    }
}
