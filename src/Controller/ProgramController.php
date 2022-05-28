<?php

namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use App\Form\CategoryType;
use App\Form\ProgramType;
use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository, CategoryRepository $categoryRepository): Response
    {
        $programs = $programRepository->findAll();
        $categories = $categoryRepository->findAll();

        if (!$programs) {
            throw $this->createNotFoundException(
                'No programs found in program\'s table.'
            );
        }
        if (!$categories) {
            throw $this->createNotFoundException(
                'No categories found in program\'s table.'
            );
        }

        return $this->render( 'program/index.html.twig',
                array('programs' => $programs, 'categories' => $categories)
        );
    }

    #[Route('/show/{id}', methods: 'GET', name: 'show')]
    public function show(Program $program, CategoryRepository $categoryRepository): Response
    {   
        $categories = $categoryRepository->findAll();

        if (!$program) {
            throw $this->createNotFoundException(
                'No programs found in program\'s table.'
            );
        }
        if (!$categories) {
            throw $this->createNotFoundException(
                'No categories found in program\'s table.'
            );
        }

        return $this->render('program/show.html.twig',
                array('program' => $program, 'categories' => $categories));
    }

    #[Route('/{programId}/season/{seasonId}', methods: 'GET', name: 'season_show')]
    #[Entity('season', options: ['id' => 'seasonId'])]
    public function showSeason(Season $season, CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findAll();

        return $this->render('program/season_show.html.twig', array('season' => $season, 'categories' => $categories));
    }

    #[Route('/{programId}/season/{seasonId}/episode/{episodeId}', methods: 'GET', name:'episode_show')]
    #[Entity('episode', options: ['id' => 'episodeId'])]
    public function showEpisode(Episode $episode, CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findAll();

        return $this->render('program/episode_show.html.twig', array('episode' => $episode, 'categories' => $categories));
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request, ProgramRepository $programRepository, CategoryRepository $categoryRepository)
    {
        $program = new Program();

        $form = $this->createForm(ProgramType::class, $program);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $programRepository->add($program, true);

            return $this->redirectToRoute('program_index');
        }

        $categories = $categoryRepository->findAll();

        return $this->renderForm('program/new.html.twig', array('form' => $form, 'categories' => $categories));
    }
}