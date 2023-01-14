<?php

namespace App\Controller;
use App\Entity\Biens;
use App\Form\UserType;
use App\Entity\Categorie;
use App\Service\MailerService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class AccueilController extends AbstractController
{      
    /**
     * @var Registry
     */
    private $doctrine;
    private $mailer;
    public function __construct(ManagerRegistry $doctrine, MailerService $mailer)
    {
        $this->doctrine = $doctrine;
        $this->mailer = $mailer;
    }

    /**
     * @Route("/accueil", name="app_accueil")
     */
    public function index( Request $request): Response
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
        $session = $request->getSession();
        $sessions = $session->all();

       // $idsessions='';
         
         if(isset($idsessions)){
            
            $idsessions=$sessions['panier'];
         }
         else{
            $idsessions='';
         }
       
        
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'biens'=>$biens,
            'categories'=>$categories,
            'randomEntities'=>$randomEntities,
            'idsessions'=>$idsessions
        ]);
    }

 /**
     * @Route("/favoris/{id}", name="app_accueil")
     */
    public function favoris($id, Request $request){

        // Récupération de l'objet de session
      $id=  $request->get('id');
        $em = $this->doctrine->getManager();
        $products = $em->getRepository(Biens::class)->findBy(['id'=>$id]);
        $session = $request->getSession();
        $panier = $session->get('panier', []); // Si pas de panier, tableau vide
        $panier[] = $products;
        
        $sessions= $session->set('panier', $panier);
        // dd($session->get('panier'));
        
        $session->getFlashBag()->add('success', 'Opération réussie !');
        // dd($session->get('panier'));
        return $this->redirectToRoute('index',[

                'sessions'=>$sessions
        ]);


    }

    #[Route('envoi/{id}', name: 'app_categorie')]
    public function envoi(Request $request,$id): Response
{       
        $id=$request->get('id');
        $em = $this->doctrine->getManager();
        $repository = $em->getRepository(Biens::class);
        $biens = $repository->findBy(['id'=>$id]);
       
        
        $form = $this->createForm(UserType::class);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()){
         $form->getData();
         $data=$form->getData();
        //  dd($data['nom']);
         $this->mailer->sendEmail(

           
            "basavane85@gmail.com",
                   $data['email'] ,
           "nouveau message"
           ,"info sur la safer",
           "Mail/index.html.twig ",
          
          
           [   
               'name'=> $data['nom'],
              
               'email'=>$data['email'],
            //    'cart'=>$cart,
            //    'categorie'=>$categorie
           ],   
           
        );
        
    }

    return $this->render('envoi/index.html.twig', [
        'controller_name'=>'AccueilController',
        'form' => $form->createView(),
    ]);
}
}
