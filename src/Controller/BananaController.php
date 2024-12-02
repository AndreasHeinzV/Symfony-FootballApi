<?php

declare(strict_types=1);

namespace App\Controller;

use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BananaController extends AbstractController
{

    #[Route('/')]
    public function bananaController(): Response
    {
        return $this->render('main/banana.html.twig');
    }
}