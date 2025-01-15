<?php

namespace App\Components\Football\Communication\Controller;

use App\Components\Football\Business\FootballBusinessFacadeInterface;
use App\Components\User\Business\UserBusinessFacadeInterface;
use App\Components\UserFavorite\Business\UserFavoriteBusinessFacadeInterface;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/team/{teamName}/{teamId}')]
class TeamDetailsController extends AbstractController
{
    public function __construct(
        private readonly FootballBusinessFacadeInterface $footballBusinessFacade,
        private readonly UserFavoriteBusinessFacadeInterface $userFavoriteBusinessFacade,
        private readonly Security $security,
        private readonly UserBusinessFacadeInterface $userBusinessFacade,
    ) {
    }

    #[Route('', name: 'team_details')]
    public function index(string $teamId): Response
    {
        $user = null;
        if ($this->security->getUser() !== null) {
            $user = $this->userBusinessFacade->getUserEntity($this->security->getUser());
        }

        $status = null !== $user;
        $favoriteStatus = null;
        if ($status) {
            $favoriteStatus = $this->userFavoriteBusinessFacade->getFavoriteStatus($user, $teamId);
        }

        return $this->render('football/team_details.html.twig', [
            'players' => $this->footballBusinessFacade->getTeam($teamId),
            'status' => $status,
            'favoriteStatus' => $favoriteStatus,
        ]);
    }

    #[Route('/add/', name: 'team_details_add')]
    public function add(string $teamId, string $teamName): Response
    {
        // dd($request->attributes->get('teamId'));
        $user = $this->userBusinessFacade->getUserEntity($this->security->getUser());
        if ($user instanceof User) {
            $this->userFavoriteBusinessFacade->addFavorite($user, $teamId);
        }

        return $this->redirectToRoute('team_details', ['teamId' => $teamId, 'teamName' => $teamName]);
    }

    #[Route('/delete/', name: 'team_details_delete')]
    public function delete(string $teamId, string $teamName): Response
    {
        $user = $this->userBusinessFacade->getUserEntity($this->security->getUser());
        if ($user instanceof User) {
            $this->userFavoriteBusinessFacade->removeFavorite($user, $teamId);
        }

        return $this->redirectToRoute('team_details', ['teamId' => $teamId, 'teamName' => $teamName]);
    }
}
