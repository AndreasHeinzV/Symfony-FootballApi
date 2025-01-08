<?php

declare(strict_types=1);

namespace App\Components\UserFavorite\Communication\Controller;

use App\Components\UserFavorite\Business\UserFavoriteBusinessFacade;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FavoritePageController extends AbstractController
{
    public function __construct(
        private UserFavoriteBusinessFacade $userFavoriteBusiness,
        private readonly Security $security,
    ) {
    }

    #[Route('/favorite-page', name: 'favorite-page')]
    public function index(): Response
    {
        $user = $this->getUser();
        if ($user instanceof User) {
            return $this->render(
                'favorite/favoritePage.html.twig',
                ['favorites' => $this->userFavoriteBusiness->getUserFavorites($user->getId())]
            );
        }
        return $this->redirectToRoute('app_login');
    }
}
