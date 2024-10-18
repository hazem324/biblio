<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Author>
 */
class AuthorRepository extends ServiceEntityRepository
{

    public function addAuthor($userName, $email,ManagerRegistry $m){
        $author = new Author();
        $author->setUsername($userName);
        $author->setEmail($email);
        $em= $m ->getManager();
        $em->persist($author);
        $em->flush();

    }
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }

    //    /**
    //     * @return Author[] Returns an array of Author objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Author
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
     
      
     
    public function orderByUserName():array
    {
           return $this ->createQueryBuilder("a") 
           ->orderBy('a.userName', 'DESC')
           ->getQuery()
           ->getResult();
    }



    public function userNameorderBy():array
    {
        $em=$this->getEntityManager();
        $query=$em->createQuery('SELECT a FROM App\Entity\Author a ORDER BY a.userName ASC');
        
           return $query->getResult();
    }

    public function filterName():array
    {
           return $this ->createQueryBuilder("a") 
           ->where('a.userName Like :name')
           ->setParameter('name','t%')
           ->getQuery()
           ->getResult();
    }


    public function recherche($name):array
{

    return $this ->createQueryBuilder("a") 
    ->where('a.userName Like :name')
    ->setParameter('name',$name)
    ->getQuery()
    ->getResult();

}





}
