<?php

namespace App\Controller;
use App\Entity\Biens;
use App\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\Persistence\ManagerRegistry;

class AccueilController extends AbstractController
{      
    /**
     * @var Registry
     */
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @Route("/accueil", name="app_accueil")
     */
    public function index(): Response
    {   
        $em = $this->doctrine->getManager();

// Création du QueryBuilder
$queryBuilder = $em->createQueryBuilder();

// Construction de la requête
$queryBuilder
    ->select('e')
    ->from('App:Biens', 'e')
    ->setMaxResults(3);

// Exécution de la requête et récupération du résultat
$result = $queryBuilder->getQuery()->getResult();

// Mélange du résultat avec la fonction shuffle de PHP
shuffle($result);

// Récupération des 3 premiers éléments du tableau mélangé
$randomEntities = array_slice($result, 0, 3);

        $em = $this->doctrine->getManager();
        $repository = $em->getRepository(Biens::class);
        $biens = $repository->findAll();
        $repository = $em->getRepository(Categorie::class);
        $categories = $repository->findAll();
        $aleatoire=shuffle($biens);
        
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'biens'=>$biens,
            'categories'=>$categories,
            'randomEntities'=>$randomEntities
        ]);
    }
}
