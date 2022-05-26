<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\EpisodeRepository;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

    #[Route('/show/{id<\d+>}', methods: 'GET', name: 'show')]
    public function show(int $id, ProgramRepository $programRepository, CategoryRepository $categoryRepository): Response
    {   
        $program = $programRepository->findBy(['id' => $id]);
        $categories = $categoryRepository->findAll();
        //var_dump($program);
        //die();

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

    #[Route('/{programId<\d+>}/season/{seasonId<\d+>}', methods: 'GET', name: 'season_show')]
    public function showSeason(int $seasonId, SeasonRepository $seasonRepository, CategoryRepository $categoryRepository)
    {
        $season = $seasonRepository->findOneBy(array('id' => $seasonId));
        $categories = $categoryRepository->findAll();

        return $this->render('program/season_show.html.twig', array('season' => $season, 'categories' => $categories));
    }

    #[Route('/{programId<\d+>}/season/{seasonId<\d+>}/episode/{episodeId<\d+>}', methods: 'GET', name:'episode_show')]
    public function showEpisode(int $episodeId, EpisodeRepository $episodeRepository, CategoryRepository $categoryRepository)
    {
        $episode = $episodeRepository->findOneBy(array('id' => $episodeId));
        $categories = $categoryRepository->findAll();
        //var_dump($episode);
        //die();

        return $this->render('program/episode_show.html.twig', array('episode' => $episode, 'categories' => $categories));
    }
}