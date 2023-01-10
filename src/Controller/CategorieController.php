<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Biens;

class CategorieController extends AbstractController
{
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }
    #[Route('/categorie/{id}', name: 'app_categorie')]
    public function index($id, Request $request): Response
    {
        $id=$request->get('id');
        

        $em = $this->doctrine->getManager();
        $repository = $em->getRepository(Biens::class);
        $biens = $repository->findBy(['id'=>$id]);
        //  dd($biens);
        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
            'biens'=>$biens
        ]);
    }
}
