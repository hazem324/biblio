<?php

namespace App\Controller;

use App\Form\BookType;
use App\Repository\BookRepository;
use App\Entity\Book;
use Doctrine\Persistence\ManagerRegistry;
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
    public function addBook(Request $req, ManagerRegistry $m): Response
    {
        $em =$m->getManager();
        $book = new Book();
        $addForm = $this->createForm(BookType::class, $book);
        $addForm-> handleRequest($req);
        if($addForm->isSubmitted() && $addForm->isValid()){
           return $this->redirectToRoute("app_book");
        }
        return $this->render('book/addBook.html.twig', [
            'addBookForm' => $addForm,
        ]);
    }


    #[Route('/edit-book/{id}', name: 'app_updateformbook')]
    public function editAuth(ManagerRegistry $m,Request $req,$id,BookRepository $rep): Response
    {
        $em=$m->getManager();
        $book=$rep->find($id);
        $addForm = $this->createForm(BookType::class, $book);
        $addForm->handleRequest($req);
        if($addForm->isSubmitted() && $addForm->isValid()){
        $em->persist($book);
        $em->flush();
        return $this->redirectToRoute('app_book');
            }
        return $this->render('book/addBook.html.twig', [
            'addBookForm' => $addForm,
        ]);
    }


    #[Route('/delete-book/{id}', name: 'app_deletebook')]
    public function deleteAuth(ManagerRegistry $m, $id,BookRepository $rep): Response
    {$em=$m->getManager();
        $book=$rep->find($id); 
        $em->remove($book);
        $em->flush();
        return $this->redirectToRoute('app_book');
            
    }
}
