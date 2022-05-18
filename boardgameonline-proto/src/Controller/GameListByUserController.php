<?php

namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameListByUserController extends AbstractController
{
    #[isGranted('ROLE_ADMIN')]
    #[Route('/favoris', name: 'app_game_favorite')]
    public function index(GameRepository $gameRepository): Response
    {
        return $this->render('game_list_by_user/index.html.twig', [
            'games' => $gameRepository->findAll(),
        ]);
    }
}
