<?php

namespace App\Repository;

use App\Entity\Car;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class);
    }

    public function getAvailableCars()
    {
        return $this->createQueryBuilder('c')
            ->where('c.isAccepted = true')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }

    public function mySearch(array $criteria)
    {
        $search = isset($criteria["search"]) ? $criteria["search"] : null;
        $filterBy = isset($criteria["filterBy"]) ? $criteria["filterBy"] : null;
        $sortBy = isset($criteria["sortBy"]) ? $criteria["sortBy"] : null;

        $listBuilder = $this->createQueryBuilder('c');

        if ($search) {
            $listBuilder->andWhere('c.make LIKE :search')
                ->setParameter('search', "%".$search."%");
        }

        if ($filterBy) {
            $listBuilder->andWhere('c.bodyType = :filterBy')
                ->setParameter('filterBy', $filterBy);
        }

        if ($sortBy) {
            switch ($sortBy){
                case "price_up":
                    $listBuilder->orderBy('c.price', 'ASC');
                    break;
                case "price_down":
                    $listBuilder->orderBy('c.price', 'DESC');
                    break;
                case "name_up":
                    $listBuilder->orderBy('c.make', 'ASC');
                    break;
                case "name_down":
                    $listBuilder->orderBy('c.make', 'DESC');
                    break;
            }
        }
        $listBuilder->andWhere('c.isAccepted = true')
        ->setMaxResults(5);

        return $listBuilder->getQuery()->getResult();
    }

    // /**
    //  * @return Car[] Returns an array of Car objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Car
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
