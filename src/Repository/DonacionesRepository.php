<?php

namespace App\Repository;

use App\Entity\Donaciones;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Donaciones>
 *
 * @method Donaciones|null find($id, $lockMode = null, $lockVersion = null)
 * @method Donaciones|null findOneBy(array $criteria, array $orderBy = null)
 * @method Donaciones[]    findAll()
 * @method Donaciones[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DonacionesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Donaciones::class);
    }

    //    /**
    //     * @return Donaciones[] Returns an array of Donaciones objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('d.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Donaciones
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
