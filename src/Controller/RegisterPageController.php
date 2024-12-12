<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RegisterPageController extends AbstractController
{
    #[Route('/register-page', name: 'register_page')]
    public function index(): Response
    {
        return $this->render('main/registerPage.html.twig');

    }
}
