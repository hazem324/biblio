<?php

namespace App\Controller;

use App\Form\BookType;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class BookController extends AbstractController
{
    #[Route('/book', name: 'app_book')]
    public function index(BookRepository $bookRepository, Request $request): Response
    {
           $books = $bookRepository->findAll();
        return $this->render('book/index.html.twig', [
            'books' => $books,
        ]);
    }


    #[Route('/Add-book', name: 'app_addbook')]
    public function addBook(Request $req): Response
    {
        $addForm = $this->createForm(BookType::class);
        $addForm-> handleRequest($req);
        return $this->render('book/addBook.html.twig', [
            'addBookForm' => $addForm,
        ]);
    }
}
