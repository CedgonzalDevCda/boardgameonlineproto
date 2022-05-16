<?php

namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(GameRepository $gameRepository): Response
    {
        return $this->render('main/index.html.twig', [
            'games' => $gameRepository->findAll(),
        ]);
    }
}
