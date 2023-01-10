<?php

namespace App\Repository;

use App\Entity\Biens;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @extends ServiceEntityRepository<Biens>
 *
 * @method Biens|null find($id, $lockMode = null, $lockVersion = null)
 * @method Biens|null findOneBy(array $criteria, array $orderBy = null)
 * @method Biens[]    findAll()
 * @method Biens[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BiensRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Biens::class);
    }

    public function save(Biens $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Biens $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Biens[] Returns an array of Biens objects
//     */
   public function findByExampleField()
   {
       // Récupération du gestionnaire d'entités
$em = $this->getDoctrine()->getManager();

// Création du QueryBuilder
$queryBuilder = $em->createQueryBuilder();

// Construction de la requête
$queryBuilder
    ->select('e')
    ->from('App:Bien', 'e')
    ->setMaxResults(3);

// Exécution de la requête et récupération du résultat
$result = $queryBuilder->getQuery()->getResult();

// Mélange du résultat avec la fonction shuffle de PHP
shuffle($result);

// Récupération des 3 premiers éléments du tableau mélangé
$randomEntities = array_slice($result, 0, 3);
        return $randomEntities;
   }

//    public function findOneBySomeField($value): ?Biens
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
