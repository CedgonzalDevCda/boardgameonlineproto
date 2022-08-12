<?php

namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameListByUserController extends AbstractController
{
    /**
     * Affiche la liste des jeux favoris d'un utilisateur connecté.
     * @param GameRepository $gameRepository
     * @return Response
     */

    #[Route('/favoris', name: 'app_game_favorite')]
    #[isGranted('ROLE_USER')]
    public function index(GameRepository $gameRepository): Response
    {
        return $this->render('game_list_by_user/index.html.twig', [
            'games' => $gameRepository->findAll(),
        ]);
    }
}
