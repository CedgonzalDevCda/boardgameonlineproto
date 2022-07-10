<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\CategoryType;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(GameRepository $gameRepository, Request $request): Response
    {
        $data = new SearchData();
        $data->page = $request->get('page', 1);
        $form = $this->createForm(CategoryType::class, $data);
        $form->handleRequest($request);
        [$minPlayer, $maxPlayer] = $gameRepository->findMinMax($data);
        $games= $gameRepository->findSearch($data);
//        dd($games);
        return $this->render('main/index.html.twig', [
            'games' => $games,
            'form' => $form->createView(),
            'minPlayer' => $minPlayer,
            'maxPlayer' => $maxPlayer,
//            'minPlayingTime' => $minPlayingTime,
//            'maxPlayingTime' => $maxPlayingTime,
        ]);
    }
}
