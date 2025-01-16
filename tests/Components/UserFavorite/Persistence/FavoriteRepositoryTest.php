<?php

declare(strict_types=1);

namespace App\Tests\Components\UserFavorite\Persistence;

use App\Components\UserFavorite\Persistence\FavoriteRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FavoriteRepositoryTest extends WebTestCase
{
    private FavoriteRepository $repository;

    protected function setUp(): void
    {
        self::bootKernel();

        $container = static::getContainer();

        $this->repository = $container->get(FavoriteRepository::class);
    }

    public function testGetAllFavorites(): void
    {
        $favorites = $this->repository->getUserFavorites(1);
        self::assertNotEmpty($favorites);
      //  dd($favorites);
    }
}
