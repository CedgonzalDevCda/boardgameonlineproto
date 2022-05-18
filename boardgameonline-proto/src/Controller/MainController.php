<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(GameRepository $gameRepository, CategoryRepository $categoryRepository): Response
    {
        return $this->render('main/index.html.twig', [
            'games' => $gameRepository->findAll(),
            'categories' => $categoryRepository->findAll(),
        ]);
    }
}
