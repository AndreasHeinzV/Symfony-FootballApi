<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Favorite;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $users = [
            ['firstName' => 'User1', 'lastName' => 'Name1', 'email' => 'user1@example.com', 'password' => 'password1'],
            ['firstName' => 'User2', 'lastName' => 'Name2', 'email' => 'user2@example.com', 'password' => 'password2'],
            ['firstName' => 'User3', 'lastName' => 'Name3', 'email' => 'user3@example.com', 'password' => 'password3'],
        ];
        $userEntities = [];

        foreach ($users as $userData) {
            $user = new User();
            $user->setFirstName($userData['firstName']);
            $user->setLastName($userData['lastName']);
            $user->setEmail($userData['email']);

            $hashedPassword = $this->passwordHasher->hashPassword($user, $userData['password']);
            $user->setPassword($hashedPassword);

            $manager->persist($user);
            $userEntities[] = $user;
        }

        $firstUserFavorites = [
            ['favoritePosition' => 1, 'teamName' => 'team1', 'teamCrest' => 'teamCrestLink1', 'teamId' => 1],
            ['favoritePosition' => 2, 'teamName' => 'team2', 'teamCrest' => 'teamCrestLink2', 'teamId' => 2],
            ['favoritePosition' => 3, 'teamName' => 'team3', 'teamCrest' => 'teamCrestLink3', 'teamId' => 3],
        ];

        foreach ($firstUserFavorites as $favoriteData) {
            $favorite = new Favorite();
            $favorite->setUser($userEntities[0]);
            $favorite->setFavoritePosition($favoriteData['favoritePosition']);
            $favorite->setTeamName($favoriteData['teamName']);
            $favorite->setTeamCrest($favoriteData['teamCrest']);
            $favorite->setTeamId($favoriteData['teamId']);
            $manager->persist($favorite);
        }

        $manager->flush();
    }
}
