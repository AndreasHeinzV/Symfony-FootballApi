<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class loginPageController extends AbstractController
{
    #[Route('/login-page', name: 'login_page')]
    public function index(): Response
    {
        return $this->render('main/loginPage.html.twig');
    }
}
