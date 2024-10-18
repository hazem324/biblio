<?php

namespace App\Controller;

use App\Form\RecherchType;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\AuthorRepository;
use App\Entity\Author;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\PersonneType;

class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(AuthorRepository $authorRepository , Request $req): Response
    {
       /* $authors = $authorRepository->findAll();
       $f= $this->createForm(RecherchType::class);
       $f->handleRequest($this->$req);
       $data= $f->get('rechcerche') ->getData();
       if($f ->isSubmitted()){
           $authorRepository -> recherche($data );
       }

       $authors = $authorRepository->filterName();
        return $this->render('author/index.html.twig', [
           'personne'  => $authors,
        ]);*/

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

    #[Route('/add-auth', name: 'app_addauthors')]
    public function addAuth(ManagerRegistry $m,Request $req): Response
    {
        $em=$m->getManager();
        $author=new Author();
        $form=$this->createForm(PersonneType::class,$author);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
        $em->persist($author);
        $em->flush();
        return $this->redirectToRoute('app_author');
            }
        return $this->render('author/addauthor.html.twig', [
            'form' => $form,
        ]);
    }


    #[Route('/edit-auth/{id}', name: 'app_updateformauthors')]
    public function editAuth(ManagerRegistry $m,Request $req,$id,AuthorRepository $rep): Response
    {
        $em=$m->getManager();
        $author=$rep->find($id);
        $form=$this->createForm(PersonneType::class,$author);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
        $em->persist($author);
        $em->flush();
        return $this->redirectToRoute('app_author');
            }
        return $this->render('author/addauthor.html.twig', [
            'form' => $form,
        ]);
    }


    #[Route('/delete-auth/{id}', name: 'app_deleteauthors')]
    public function deleteAuth(ManagerRegistry $m,Request $req,$id,AuthorRepository $rep): Response
    {$em=$m->getManager();
        $author=$rep->find($id); 
        $em->remove($author);
        $em->flush();
        return $this->redirectToRoute('app_author');
            
    }


    
}

