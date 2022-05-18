<?php

namespace App\Controller;

use App\Entity\Friend;
use App\Form\FriendType;
use App\Repository\FriendRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/friend')]
class FriendController extends AbstractController
{
    #[Route('/', name: 'app_friend_index', methods: ['GET'])]
    public function index(FriendRepository $friendRepository): Response
    {
        return $this->render('friend/index.html.twig', [
            'friends' => $friendRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_friend_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FriendRepository $friendRepository): Response
    {
        $friend = new Friend();
        $form = $this->createForm(FriendType::class, $friend);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $friendRepository->add($friend, true);

            return $this->redirectToRoute('app_friend_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('friend/new.html.twig', [
            'friend' => $friend,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_friend_show', methods: ['GET'])]
    public function show(Friend $friend): Response
    {
        return $this->render('friend/show.html.twig', [
            'friend' => $friend,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_friend_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Friend $friend, FriendRepository $friendRepository): Response
    {
        $form = $this->createForm(FriendType::class, $friend);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $friendRepository->add($friend, true);

            return $this->redirectToRoute('app_friend_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('friend/edit.html.twig', [
            'friend' => $friend,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_friend_delete', methods: ['POST'])]
    public function delete(Request $request, Friend $friend, FriendRepository $friendRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$friend->getId(), $request->request->get('_token'))) {
            $friendRepository->remove($friend, true);
        }

        return $this->redirectToRoute('app_friend_index', [], Response::HTTP_SEE_OTHER);
    }
}
