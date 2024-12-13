<?php

declare(strict_types=1);

namespace App\Components\UserLogin\Communication\Controller;

use App\Components\User\Persistence\UserMapper;
use App\Components\UserLogin\Business\UserLoginFacadeInterface;
use App\Components\UserLogin\Communication\Form\LoginForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class loginPageController extends AbstractController
{
    /*
    public function __construct(
        private readonly UserMapper $userMapper,
        private readonly UserLoginFacadeInterface $userLoginFacade,
    ) {
    }
*/
    /*
        #[Route('/login-page', name: 'login_page', methods: ['GET'])]
        public function index(): Response
        {
            $form = $this->createForm(LoginForm::class);

            return $this->render('userLogin/loginPage.html.twig', ['login_form' => $form]);
        }

        #[Route('/login-page', name: 'login_page_post', methods: ['POST'])]
        public function loginUser(Request $request): Response
        {
            $form = $this->createForm(LoginForm::class);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();

                $array = [
                    'email' => $data['email'],
                    'password' => $data['password'],
                ];
                $userDto = $this->userMapper->createUserDto($array);
                $this->userLoginFacade->loginUser($userDto);
            }

            return $this->render('userLogin/loginPage.html.twig', ['login_form' => $form]);
        }
    */
    /**
     * @Route("/login", name="app_login", methods={"GET", "POST"})
     */
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        $form = $this->createForm(LoginForm::class, [
            'email' => $lastUsername,
        ]);

        return $this->render('userLogin/loginPage.html.twig', [
            'login_form' => $form->createView(),
            'error' => $error,
        ]);
    }

    /**
     * @Route("/logout", name="app_logout", methods={"GET"})
     */
    public function logout(): void
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
