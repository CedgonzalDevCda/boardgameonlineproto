<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserAuthorType;
use App\Form\UserPasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class UserController extends AbstractController
{
    /**
     * Affiche les informations de l'utilisateur connecté.
     *
     * @return Response
     */
    #[Route('/user', name: 'app_user')]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'user' => 'UserController',
        ]);
    }

    /**
     * Accède à la charte utilisateur de l'auteur de jeux.
     * L'acceptation de cette charte permet d'ajouter le rôle Author à l'utilisateur connecté.
     */
    #[Route('/user/become-author/{id}', name: 'app_become_author', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function becomeAuthor(User $user, Request $request, EntityManagerInterface $manager):Response{
        $form = $this->createForm(UserAuthorType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //
            $user->setisAuthor(true);
            //
            $user->setRoles($user->getRoles());

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('app_user');
        }

        return $this->render('user/become_author.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }



    /**
     * Cette route permet de modifier le mot de passe de l'utilisateur connecté.
     *
     * @param User $user
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param UserPasswordHasherInterface $hasher
     * @return Response
     */
    #[Route('/user/change-password/{id}', name: 'app_edit_password', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function editPassword(User $user, Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $hasher): Response
    {
        $form = $this->createForm(UserPasswordType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($hasher->isPasswordValid($user, $form->getData()['plainPassword'])) {
                $user->setPassword(
                    $hasher->hashPassword(
                        $user,
                        $form->getData()['newPassword']
                    )
                );

                $this->addFlash(
                    'success',
                    'Le mot de passe a été modifié.'
                );

                $manager->persist($user);
                $manager->flush();

                return $this->redirectToRoute('app_user');
            } else {
                $this->addFlash(
                    'warning',
                    'Le mot de passe renseigné est incorrect.'
                );
            }
        }


        return $this->render('user/edit_Password.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }
}
