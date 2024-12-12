<?php

declare(strict_types=1);

namespace App\Controller;

use App\Components\Football\FootballBusinessFacadeInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomePageController extends AbstractController
{
    public function __construct(private readonly FootballBusinessFacadeInterface $footballBusinessFacade)
    {
    }

    #[Route('/', name: 'homepage')]
    public function homePageController(): Response
    {
        return $this->render('main/homePage.html.twig', ['leagues' => $this->footballBusinessFacade->getLeagues()]);
    }
}
