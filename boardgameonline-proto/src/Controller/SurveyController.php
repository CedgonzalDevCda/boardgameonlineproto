<?php

namespace App\Controller;

use App\Entity\Survey;
use App\Form\SurveyType;
use App\Repository\SurveyRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/survey')]
#[IsGranted('ROLE_AUTHOR')]
class SurveyController extends AbstractController
{
    /**
     * Affiche la liste des questionnaires créés par l'auteur connecté
     *
     * @param SurveyRepository $surveyRepository
     * @return Response
     */
    #[Route('/', name: 'app_survey_index', methods: ['GET'])]
    public function index(SurveyRepository $surveyRepository): Response
    {
        return $this->render('survey/index.html.twig', [
            'surveys' => $surveyRepository->findAll(),
        ]);
    }

    /**
     * Créer un nouveau questionnaire pour l'associer à un jeu.
     * @param Request $request
     * @param SurveyRepository $surveyRepository
     * @return Response
     */
    #[Route('/new', name: 'app_survey_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SurveyRepository $surveyRepository): Response
    {
        $survey = new Survey();
        $form = $this->createForm(SurveyType::class, $survey);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $surveyRepository->add($survey, true);

            return $this->redirectToRoute('app_survey_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('survey/new.html.twig', [
            'survey' => $survey,
            'form' => $form,
        ]);
    }

    /**
     * Afficher le questionnaire.
     * @param Survey $survey
     * @return Response
     */
    #[Route('/{id}', name: 'app_survey_show', methods: ['GET'])]
    public function show(Survey $survey): Response
    {
        return $this->render('survey/show.html.twig', [
            'survey' => $survey,
        ]);
    }

    /**
     * Modifier le questionnaire.
     * @param Request $request
     * @param Survey $survey
     * @param SurveyRepository $surveyRepository
     * @return Response
     */
    #[Route('/{id}/edit', name: 'app_survey_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Survey $survey, SurveyRepository $surveyRepository): Response
    {
        $form = $this->createForm(SurveyType::class, $survey);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $surveyRepository->add($survey, true);

            return $this->redirectToRoute('app_survey_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('survey/edit.html.twig', [
            'survey' => $survey,
            'form' => $form,
        ]);
    }

    /**
     * Supprimer le questionnaire
     * @param Request $request
     * @param Survey $survey
     * @param SurveyRepository $surveyRepository
     * @return Response
     */
    #[Route('/{id}', name: 'app_survey_delete', methods: ['POST'])]
    public function delete(Request $request, Survey $survey, SurveyRepository $surveyRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$survey->getId(), $request->request->get('_token'))) {
            $surveyRepository->remove($survey, true);
        }

        return $this->redirectToRoute('app_survey_index', [], Response::HTTP_SEE_OTHER);
    }
}
