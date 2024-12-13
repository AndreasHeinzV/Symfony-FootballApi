<?php

declare(strict_types=1);

namespace App\Components\ResetPassword\Communication\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PasswordFailedPageController extends AbstractController
{
    #[Route('/password-failed-page', name: 'password_failed_page')]
    public function index(): Response
    {
        return $this->render('passwordReset/passwordFailedPageController.html.twig');
    }
}
