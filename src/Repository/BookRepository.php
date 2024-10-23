<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

/**
 * @extends ServiceEntityRepository<Book>
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }


    public function filterBookByTitle( $title):array
    {    
        return $this-> createQueryBuilder("a")
        ->where("a.title LIKE :title ")
        ->setParameter('title',$title)
        ->getQuery()
        ->getResult();
    }

    public function filterBookByTitleAndCategorir ($title, $category) : array 
    {
        return $this->createQueryBuilder('a')
        ->where('a.title LIKE :title ')
        ->setParameter('title',$title)
        ->andWhere('a.category LIKE :category')
        ->setParameter('category',$category)
        ->getQuery()
        ->getResult();
    }

    //    /**
    //     * @return Book[] Returns an array of Book objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Book
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
