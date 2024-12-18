<?php

declare(strict_types=1);

namespace App\Components\Football\Communication\Controller;

use App\Components\Football\Business\FootballBusinessFacadeInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LeagueTeamsController extends AbstractController
{
    public function __construct(private FootballBusinessFacadeInterface $footballBusinessFacade)
    {
    }

    #[Route('/league/{leagueName}', name: 'league_detail')]
    public function index(Request $request): Response
    {
        // dd($request);

        $page = $request->query->get('page');



        if ('competitions' !== $page) {
            return $this->redirectToRoute('pageNotFound', ['page' => $page]);
        }

        return $this->render(
            'football/leagueTeams.html.twig',
            ['teams' => $this->footballBusinessFacade->getLeagueTeams($request->get('name'))]
        );
    }
}
