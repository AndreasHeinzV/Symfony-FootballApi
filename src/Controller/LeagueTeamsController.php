<?php

declare(strict_types=1);

namespace App\Controller;

use App\Components\Football\FootballBusinessFacadeInterface;
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
        dump($page);
        /*
        if ('competition' !== $page) {
            return $this->redirectToRoute('pageNotFound');
        }
*/
        return $this->render('main/leagueTeams.html.twig', ['teams' => $this->footballBusinessFacade->getLeagueTeams($request->get('name'))]);
    }
}
