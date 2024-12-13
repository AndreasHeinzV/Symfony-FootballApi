<?php

declare(strict_types=1);

namespace App\Components\UserFavorite\Communication\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FavoritePageController extends AbstractController
{
    #[Route('/favorite-page', name: 'favorite-page')]
    public function index(): Response
    {
        return $this->render('main/favoritePage.html.twig');
    }
}
