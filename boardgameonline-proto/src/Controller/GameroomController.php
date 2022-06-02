<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Gameroom;
use App\Form\GameroomType;
use App\Repository\FriendRepository;
use App\Repository\GameRepository;
use App\Repository\GameroomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/gameroom')]
class GameroomController extends AbstractController
{
    /**
     * Affiche le formulaire pour la création d'une table de jeu
     * @param $id
     * @param GameRepository $gameRepository
     * @param GameroomRepository $gameroomRepository
     * @param FriendRepository $friendRepository
     * @return Response
     */
    #[Route('/{id}', name: 'app_gameroom_index', methods: ['GET','POST'])]
    public function index($id, GameRepository$gameRepository, GameroomRepository $gameroomRepository, FriendRepository $friendRepository): Response
    {
        return $this->render('gameroom/index.html.twig', [
            'game' => $gameRepository->find($id), // test
            'gamerooms' => $gameroomRepository->findAll(),
            'friends' => $friendRepository->findAll(),
        ]);
    }

    /**
     * Créer la table de jeu pour un jeu avec la liste d'amis prédéfinie
     * @param Request $request
     * @param Game $id
     * @param GameRepository $gameRepository
     * @param GameroomRepository $gameroomRepository
     * @return Response
     */
    #[Route('/{id}/new', name: 'app_gameroom_new', methods: ['GET', 'POST'], )]
//options:
    public function new(Request $request, Game $id, GameRepository$gameRepository, GameroomRepository $gameroomRepository): Response
    {
        $gameroom = new Gameroom();
//        if ($request->isXmlHttpRequest())
//        {
//
//        }
//        $form = $this->createForm(GameroomType::class, $gameroom);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $gameroomRepository->add($gameroom, true);
//
//            return $this->redirectToRoute('app_gameroom_index', [], Response::HTTP_SEE_OTHER);
//        }
//
//        return $this->renderForm('gameroom/new.html.twig', [
//            'game' => $gameRepository->find($id), // test
//            'gameroom' => $gameroom,
//            'form' => $form,
//        ]);
    }

    /**
     * Afficher la table de jeu avec les utilisateurs et invités
     * @param Gameroom $gameroom
     * @return Response
     */
//    #[Route('/{id}/show', name: 'app_gameroom_show', methods: ['GET'])]
//    public function show(Gameroom $gameroom): Response
////    , GameRepository $gameRepository
//    {
//        return $this->render('gameroom/show.html.twig', [
//            'gameroom' => $gameroom,
//        ]);
//    }


    /**
     * Rendre invisible la table de jeu
     * @param Request $request
     * @param Gameroom $gameroom
     * @param GameroomRepository $gameroomRepository
     * @return Response
     */
    #[Route('/{id}', name: 'app_gameroom_delete', methods: ['POST'])]
    public function delete(Request $request, Gameroom $gameroom, GameroomRepository $gameroomRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gameroom->getId(), $request->request->get('_token'))) {
            $gameroomRepository->remove($gameroom, true);
        }

        return $this->redirectToRoute('app_gameroom_index', [], Response::HTTP_SEE_OTHER);
    }
}
