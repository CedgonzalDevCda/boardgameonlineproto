<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\GameListByUser;
use App\Entity\UserListByEvents;
use App\Form\GameType;
use App\Repository\CategoryRepository;
use App\Repository\GameListByUserRepository;
use App\Repository\GameRepository;
use App\Repository\UserListByEventsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/game')]
class GameController extends AbstractController
{
    #[Route('/', name: 'app_game_index', methods: ['GET'])]
    public function index(GameRepository $gameRepository): Response
    {
        return $this->render('game/index.html.twig', [
            'games' => $gameRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_game_new', methods: ['GET', 'POST'])]
    public function new(Request $request, GameRepository $gameRepository): Response
    {
        $game = new Game();
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $gameRepository->add($game, true);

            return $this->redirectToRoute('app_game_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('game/new.html.twig', [
            'game' => $game,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_game_show', methods: ['GET'])]
    public function show(Game $game): Response
    {
        return $this->render('game/show.html.twig', [
            'game' => $game,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_game_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Game $game, GameRepository $gameRepository): Response
    {
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $gameRepository->add($game, true);

            return $this->redirectToRoute('app_game_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('game/edit.html.twig', [
            'game' => $game,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_game_delete', methods: ['POST'])]
    public function delete(Request $request, Game $game, GameRepository $gameRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$game->getId(), $request->request->get('_token'))) {
            $gameRepository->remove($game, true);
        }

        return $this->redirectToRoute('app_game_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/subscribe', name: 'app_game_signup', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function subscribe(EntityManagerInterface $manager, Game $game, GameListByUserRepository $gameListByUserRepository): Response
    {
        $user = $this->getUser();

        if(!$user) return $this->redirectToRoute('app_login');

        if($game->isUserFavorite($user)){
            $signedUp = $gameListByUserRepository->findOneBy([
                'games' => $game,
                'users' => $user
            ]);
            //TODO: EntityManagerInterface Pas nécessaire - remplacer $manager par $gameListByUserRepository
            $manager->remove($signedUp);
            $manager->flush();

            return $this->redirectToRoute('app_game_show',['id' => $game->getId()]);
        }

        $signUp = new GameListByUser();
        $signUp->setGames($game)
            ->setUsers($user);

        // TODO: remplacer $manager par $gameListByUserRepository et persist par add
        $manager-> persist($signUp);
        $manager->flush();

        return $this->redirectToRoute('app_game_show',['id' => $game->getId()]);
    }
}
