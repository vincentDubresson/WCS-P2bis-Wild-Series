<?php

namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use App\Repository\ActorRepository;
use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('', name: 'user_')]
class DefaultController extends AbstractController
{


    /* HOME PAGE */
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('public/index.html.twig');
    }



    /* PROGRAM PAGES */
    #[Route('/program/', name: 'program_list')]
    public function programList(ActorRepository $actorRepository, ProgramRepository $programRepository, CategoryRepository $categoryRepository): Response
    {
        $programs = $programRepository->findAll();
        $categories = $categoryRepository->findAll();
        $actors = $actorRepository->findAll();


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

        return $this->render( 'public/program_list.html.twig',
                array('actors' => $actors, 'programs' => $programs, 'categories' => $categories)
        );
    }

    #[Route('/program/show/{id}', methods: 'GET', name: 'program_show')]
    public function show(Program $program, ActorRepository $actorRepository, CategoryRepository $categoryRepository): Response
    {   
        $categories = $categoryRepository->findAll();
        $actors = $actorRepository->findAll();
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

        return $this->render('public/program_show.html.twig',
                array('actors' => $actors, 'program' => $program, 'categories' => $categories));
    }

    #[Route('/program/{programId}/season/{seasonId}', methods: 'GET', name: 'season_show')]
    #[Entity('season', options: ['id' => 'seasonId'])]
    public function showSeason(Season $season, ActorRepository $actorRepository, CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findAll();
        $actors = $actorRepository->findAll();


        return $this->render('public/season_show.html.twig', array('actors' => $actors, 'season' => $season, 'categories' => $categories));
    }

    #[Route('/program/{programId}/season/{seasonId}/episode/{episodeId}', methods: 'GET', name:'episode_show')]
    #[Entity('episode', options: ['id' => 'episodeId'])]
    public function showEpisode(Episode $episode, ActorRepository $actorRepository,  CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findAll();
        $actors = $actorRepository->findAll();

        return $this->render('public/episode_show.html.twig', array('actors' => $actors, 'episode' => $episode, 'categories' => $categories));
    }



    /* CATEGORY PAGES */
    #[Route('/category', name: 'category_list')]
    public function categoryList(CategoryRepository $categoryRepository, ActorRepository $actorRepository): Response
    {
        $categories = $categoryRepository->findAll();
        $actors = $actorRepository->findAll();


        return $this->render('public/category_list.html.twig', array('actors' => $actors, 'categories' => $categories));
    }

    #[Route('/category/show/{category}', methods: 'GET', name: 'show')]
    public function listByCategory(string $category, ActorRepository $actorRepository,  ProgramRepository $programRepository, CategoryRepository $categoryRepository): Response
    {   
        $categoryName = $categoryRepository->findOneBy(['name' => $category]);
        $programs = $programRepository->findBy(['category' => $categoryName],
                                                ['id' => 'DESC'], 3);
        $categories = $categoryRepository->findAll();
        $actors = $actorRepository->findAll();


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

        return $this->render('public/category_show.html.twig', 
                array('actors' => $actors, 'programs' => $programs, 'categories' => $categories, 'category' => $categoryName));
    }


    /* ACTOR PAGES */
    #[Route('/actor/', name: 'actor_list')]
    public function actorList(ActorRepository $actorRepository, CategoryRepository $categoryRepository): Response
    {
        $actors = $actorRepository->findAll();
        $categories = $categoryRepository->findAll();

        if (!$actors) {
            throw $this->createNotFoundException(
                'No actors found in actor\'s table.'
            );
        }
        if (!$categories) {
            throw $this->createNotFoundException(
                'No categories found.'
            );
        }

        return $this->render( 'public/actor_list.html.twig',
                array('actors' => $actors, 'categories' => $categories)
        );
    }

    #[Route('/actor/show/{id}', methods: 'GET', name: 'show')]
    public function listByActor(int $id, ActorRepository $actorRepository, CategoryRepository $categoryRepository): Response
    {   
        $actor = $actorRepository->findOneBy(['id' => $id]);
        $categories = $categoryRepository->findAll();
        $actors = $actorRepository->findAll();


        if (!$actor) {
            throw $this->createNotFoundException(
                'No programs found in program\'s table.'
            );
        }
        if (!$categories) {
            throw $this->createNotFoundException(
                'No categories found in program\'s table.'
            );
        }

        return $this->render('public/actor_show.html.twig', 
                array('actors' => $actors, 'actor' => $actor, 'categories' => $categories));
    }
}