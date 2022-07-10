<?php

namespace App\Controller;

use App\Entity\ReportBug;
use App\Form\ReportBugType;
//use App\Service\MailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ReportBugController extends AbstractController
{
    /**
     * Formulaire permettant l'envoi d'email à l'administratin pour reporter un bug constaté sur un jeu ou le site.
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param MailService $mailService
     * @return Response
     * @throws TransportExceptionInterface
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */

//MailService $mailService param to add
    #[Route('/report/bug', name: 'app_report_bug')]
    public function index(
        Request $request,
        EntityManagerInterface $manager,
        MailerInterface $mailer
    ): Response
    {
        $reportBug = new ReportBug();

        // Si user connecté, pré-remplir les champs Nom / Prénom et Adresse email
        if ($this->getUser()) {
            $reportBug->setFullName($this->getUser()->getUsername());
        }

        $form = $this->createForm(ReportBugType::class, $reportBug);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $reportBug = $form->getData();
            $manager->persist($reportBug);
            $manager->flush();

            // Email test
            $email = (new Email())
                ->from('test@example.com')
                ->to('cedgonzalezdevcda@gmail.com')
                ->subject('Time for Symfony Mailer!')
                ->text('Sending emails is fun again!')
                ->html('See Twig integration for better HTML integration!');
            try {
                $mailer->send($email);
            } catch (TransportExceptionInterface $e) {
            }

//            Email

//            $mailService->sendEmail(
//                $reportBug->getEmail(),
//                $reportBug->getSubject(),
//                'emails/reportbug.html.twig',
//                ['reportBug' => $reportBug],
//            );
//
            $this->addFlash(
                'success',
                'Votre report a été envoyé avec succès !'
            );

            return $this->redirectToRoute('app_report_bug');
        } else {
            $this->addFlash(
                'danger',
                $form->getErrors()
            );
        }
        return $this->render('report_bug/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
