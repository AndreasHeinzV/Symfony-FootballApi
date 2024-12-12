<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PasswordFailedPageController extends AbstractController
{
    #[Route('/password-failed-page', name: 'password_failed_page')]
    public function index(): Response
    {
        return $this->render('main/passwordFailedPageController.html.twig');
    }
}
