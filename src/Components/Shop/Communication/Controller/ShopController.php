<?php

declare(strict_types=1);

namespace App\Components\Shop\Communication\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ShopController extends AbstractController
{
    #[Route('/shop', name: 'club_shop')]
    public function index(): Response
    {

        return $this->render('shop/shop.html.twig');
    }
}
