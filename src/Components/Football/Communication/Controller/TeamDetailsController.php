<?php

namespace App\Components\Football\Communication\Controller;

use App\Components\Football\Business\FootballBusinessFacadeInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TeamDetailsController extends AbstractController
{
    public function __construct(private readonly FootballBusinessFacadeInterface $footballBusinessFacade)
    {
    }

    #[Route('/team/{teamName}', name: 'team_details')]
    public function index(Request $request): Response
    {
        $page = $request->query->get('page');

        return $this->render('football/team_details.html.twig', [
            'players' => $this->footballBusinessFacade->getTeam(
                $request->get('id')
            ),
            'status' => false,
            'favoriteStatus' => false,
        ]);
    }
}
