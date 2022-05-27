<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('category/list.html.twig', ['categories' => $categories]);
    }

    #[Route('/show/{category}', methods: 'GET', name: 'show')]
    public function listByCategory(string $category, ProgramRepository $programRepository, CategoryRepository $categoryRepository): Response
    {   
        $categoryName = $categoryRepository->findOneBy(['name' => $category]);
        $programs = $programRepository->findBy(['category' => $categoryName],
                                                ['id' => 'DESC'], 3);
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

        return $this->render('category/show.html.twig', 
                array('programs' => $programs, 'categories' => $categories, 'category' => $categoryName));
    }

    #[Route('/new', name: 'new')]
    public function new(CategoryRepository $categoryRepository): Response
    {
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);

        $categories = $categoryRepository->findAll();

        return $this->renderForm('category/new.html.twig', array('form' => $form, 'categories' => $categories));
    }
}
