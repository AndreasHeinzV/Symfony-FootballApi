<?php

declare(strict_types=1);

namespace App\Components\UserRegister\Communication\Controller;

use App\Components\User\Persistence\UserEntityManager;
use App\Components\User\Persistence\UserMapper;
use App\Components\UserRegister\Communication\Form\RegisterForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RegisterPageController extends AbstractController
{
    public function __construct(private readonly UserMapper $userMapper, private readonly UserEntityManager $userEntityManager)
    {
    }

    #[Route('/register-page', name: 'register_page', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $form = $this->createForm(RegisterForm::class);

        return $this->render('register/registerPage.html.twig', ['registration_form' => $form]);
    }

    #[Route('/register-page', name: 'register_page_post', methods: ['POST'])]
    public function register(Request $request): Response
    {
        $form = $this->createForm(RegisterForm::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $array = [
                'firstName' => $data['firstName'],
                'lastName' => $data['lastName'],
                'email' => $data['email'],
                'password' => $data['password'],
            ];

            $userDto = $this->userMapper->createUserDto($array);
            $this->userEntityManager->saveUser($userDto);

        }

        return $this->render('register/registerPage.html.twig', ['registration_form' => $form]);
    }
}
