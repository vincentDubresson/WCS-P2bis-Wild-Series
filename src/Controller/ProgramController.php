<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];

            return $this->redirectToRoute('program_show', ['id' => $id]);
        }

        return $this->render('program/index.html.twig', [
            'website' => 'Wild Series',
        ]);
    }

    #[Route('/show/{id<\d+>}', methods: 'GET', name: 'show')]
    public function show(int $id = 1): Response
    {
        return $this->render('program/show.html.twig', ['id' => $id]);
    }
}