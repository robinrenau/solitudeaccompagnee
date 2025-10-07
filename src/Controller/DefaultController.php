<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index()
    {
        // Redirige l'utilisateur si il est déjà connecté vers la page /home :
        if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('homepage');
        }

        return $this->render('default/index.html.twig');
    }

    #[Route('/home', name: 'homepage')]
    #[IsGranted('ROLE_USER')]
    public function home()
    {
        return $this->render('default/home.html.twig');
    }

    public function searchCategory(CategoryRepository $categoryRepository)
    {
        return $this->render('default/_searchcategory.html.twig', [
            'categories' => $categoryRepository->findAll()
        ]);
    }
}

