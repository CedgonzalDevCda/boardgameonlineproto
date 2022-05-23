<?php

namespace App\Controller;

use App\Entity\Gameroom;
use App\Form\GameroomType;
use App\Repository\FriendRepository;
use App\Repository\FriendsListRepository;
use App\Repository\GameRepository;
use App\Repository\GameroomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/gameroom')]
class GameroomController extends AbstractController
{
    #[Route('/', name: 'app_gameroom_index', methods: ['GET'])]
    public function index(GameroomRepository $gameroomRepository, FriendRepository $friendRepository): Response
    {
        return $this->render('gameroom/index.html.twig', [
            'gamerooms' => $gameroomRepository->findAll(),
            'friends' => $friendRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_gameroom_new', methods: ['GET', 'POST'])]
    public function new(Request $request, GameroomRepository $gameroomRepository): Response
    {
        $gameroom = new Gameroom();
        $form = $this->createForm(GameroomType::class, $gameroom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $gameroomRepository->add($gameroom, true);

            return $this->redirectToRoute('app_gameroom_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('gameroom/new.html.twig', [
            'gameroom' => $gameroom,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_gameroom_show', methods: ['GET'])]
    public function show(Gameroom $gameroom, GameRepository $gameRepository): Response
    {
        return $this->render('gameroom/show.html.twig', [
            'gameroom' => $gameroom,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_gameroom_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Gameroom $gameroom, GameroomRepository $gameroomRepository): Response
    {
        $form = $this->createForm(GameroomType::class, $gameroom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $gameroomRepository->add($gameroom, true);

            return $this->redirectToRoute('app_gameroom_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('gameroom/edit.html.twig', [
            'gameroom' => $gameroom,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_gameroom_delete', methods: ['POST'])]
    public function delete(Request $request, Gameroom $gameroom, GameroomRepository $gameroomRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gameroom->getId(), $request->request->get('_token'))) {
            $gameroomRepository->remove($gameroom, true);
        }

        return $this->redirectToRoute('app_gameroom_index', [], Response::HTTP_SEE_OTHER);
    }
}
