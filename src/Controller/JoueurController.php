<?php

namespace App\Controller;



use App\Repository\JoueurRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JoueurController extends AbstractController
{
    #[Route('/joueur', name: 'app_joueur')]
    public function index(): Response
    {
        return $this->render('joueur/index.html.twig', [
            'controller_name' => 'JoueurController',
        ]);
    }
    #[Route('/listJoueur', name: 'list_joueurs')]
    public function list(JoueurRepository $repository)
    {
        $joueurs= $repository->findBy(array(),array('nom'=>'ASC'));

        return $this->render("joueur/listjoueur.html.twig",
            array('tabJoueurs'=>$joueurs));
    }
    #[Route('/listJoueurT', name: 'list_joueurst')]
    public function list1(JoueurRepository $repository)
    {
        $joueurs= $repository->findBy(array(),array('nom'=>'ASC'));

        return $this->render("joueur/listjoueur.html.twig",
            array('tabJoueurs'=>$joueurs,
            'tabJoueurs'=>$repository->ShowJoueurs()));
    }
}
