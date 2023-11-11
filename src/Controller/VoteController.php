<?php

namespace App\Controller;


use App\Entity\Vote;
use App\Form\VoteType;
use App\Repository\JoueurRepository;
use App\Repository\VoteRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoteController extends AbstractController
{
    #[Route('/vote', name: 'app_vote')]
    public function index(): Response
    {
        return $this->render('vote/index.html.twig', [
            'controller_name' => 'VoteController',
        ]);
    }
    #[Route('/addVote', name: 'list_votes')]
    public function addVote(Request $request,ManagerRegistry $managerRegistry)
    {
       $vote= new Vote();
       $form= $this->createForm(VoteType::class,$vote);
       $form->handleRequest($request);
       if($form->isSubmitted()){
        $vote-> setDate (new \DateTime());
        $em= $managerRegistry->getManager();
        $em->persist($vote);
       $em->flush();
       return $this->redirectToRoute("app_vote");
       }
       return $this->renderForm("vote/add.html.twig"
            ,array('formulaireVote'=>$form));
}
#[Route('/listVote/{id}', name: 'list_vote')]
    public function list(VoteRepository $repository,$id,JoueurRepository $repo)
    {
        $votes = $repository->getVotesByJoueur($id);
        $joueur = $repo->find($id);

        return $this->render("vote/listvote.html.twig",
            array('tabvote'=>$votes,'joueur'=>$joueur));
    }
}
