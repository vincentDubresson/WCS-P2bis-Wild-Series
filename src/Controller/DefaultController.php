<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/list/{page}', requirements: ['page'=>'\d+'], methods: 'GET', name: 'series_list')]
    /* OU #[Route('/list/{page<\d+>}', methods: 'GET', name: 'series_list')] */
    public function list(int $page = 1): Response
    {
        return $this->render('series/list.html.twig', ['page' => $page]);
    }


}