<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AuthorRepository;

class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }
    #[Route('/showauthor/{username}', name: 'show_author')]
    public function showAuthor($username){
        return $this ->render("author/show.html.twig",array('nameAuthor' =>$username));
    }

    #[Route('/liste', name: 'liste_author')]
    public function liste(AuthorRepository $repository){
         /*$authors=array(
        array('id'=>1,'username'=>'ahmed','email'=>'ahmed@gmail.com','nb_book'=>100,'action'=>''),
        array('id'=>2,'username'=>'skander','email'=>'skander@gmail.com','nb_book'=>200),
        array('id'=>3,'username'=>'ali','email'=>'ali@gmail.com','nb_book'=>300),
        );*/
        $authors=$repository->findAll();

        return $this->render('author/authors.html.twig',array('tabAuthors'=>$authors) 
        );
    }
    #[Route('/addliste', name: 'liste_author')]
    public function addAuthor(){
        $author=new author();
        $author->setEmail("user4@gmail.com");
        $author->setUsername("user3");
        $em-=$managerRegistry->getManager();
        $em->persist($author);
        $em->flush();
        return $this->redirectToRoute("liste_authors");
    }
    
}
