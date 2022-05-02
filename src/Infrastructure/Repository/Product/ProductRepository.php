<?php

namespace App\Infrastructure\Repository\Product;

use App\Domain\Model\Product\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function add(Product $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function remove(Product $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

     /**
      * @return Product[] Returns an array of Product objects
      */
    public function findByFamilyName(string $familyName,int $numResults)
    {
        return $this->createQueryBuilder('p')
            ->innerJoin('p.family', 'f')
            ->andWhere('f.name = :val')
            ->setParameter('val', $familyName)
            ->setMaxResults($numResults)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findBySlug(string $slug): ?Product
    {
        return $this->createQueryBuilder('p')
            ->innerJoin('p.family', 'f')
            ->andWhere('p.slug = :val')
            ->setParameter('val', $slug)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }


    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findById(string $id): ?Product
    {
        return $this->find($id);
    }
}
