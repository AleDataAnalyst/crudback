<?php

namespace App\Repository;

use App\Entity\Donante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<Donante>
 *
 * @implements PasswordUpgraderInterface<Donante>
 *
 * @method Donante|null find($id, $lockMode = null, $lockVersion = null)
 * @method Donante|null findOneBy(array $criteria, array $orderBy = null)
 * @method Donante[]    findAll()
 * @method Donante[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DonanteRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Donante::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof Donante) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    // Nombre de donante por id
    public function findNombreDonanteByID($nombre) {
        return $this->createQueryBuilder('d')
            ->andWhere('d.nombre = :nombre')
            ->setParameter('nombre', $nombre)
            ->getQuery()
            ->getResult();
    }
    
    
    // Apellido
    public function findByApellido($apellido) {
        return $this->createQueryBuilder('d')
            ->andWhere('d.apellido = :apellido')
            ->setParameter('apellido', $apellido)
            ->getQuery()
            ->getResult();
    }
    
    
    // Email
    public function findByEmail($email) {
        return $this->createQueryBuilder('d')
            ->andWhere('d.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getResult();
    }

    // Donantes por Tipo de Rol
    public function findDonantesByRol($rol) {
        return $this->createQueryBuilder('d')
            ->andWhere('d.roles LIKE :rol')
            ->setParameter('rol', '%' . $rol . '%')
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Donante[] Returns an array of Donante objects
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

    //    public function findOneBySomeField($value): ?Donante
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
