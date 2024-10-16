<?php

namespace App\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\AuthorRepository;
use App\Entity\Author;
use Doctrine\Persistence\ManagerRegistry;

class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(AuthorRepository $authorRepository): Response
    {
        $authors = $authorRepository->findAll();
        return $this->render('author/index.html.twig', [
           'personne'  => $authors,
        ]);
    }

    #[Route('/addAuth/{userName}/{email}', name: 'app_addauthor')]
    public function add(ManagerRegistry $m ,$userName, $email , AuthorRepository $authorRepository): Response
    {
        $authorRepository -> addAuthor($userName, $email,$m );
        
        return $this->redirectToRoute('app_author');
    }
}
