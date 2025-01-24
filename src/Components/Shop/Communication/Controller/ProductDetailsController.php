<?php

declare(strict_types=1);

namespace App\Components\Shop\Communication\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductDetailsController extends AbstractController
{
    #[Route('/product-details', name: 'product_details')]
    public function index(): Response
    {
        return $this->render('details/index.html.twig');
    }
}
