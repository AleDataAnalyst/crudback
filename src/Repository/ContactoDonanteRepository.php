<?php

namespace App\Repository;

use App\Entity\ContactoDonante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ContactoDonante>
 *
 * @method ContactoDonante|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactoDonante|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactoDonante[]    findAll()
 * @method ContactoDonante[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactoDonanteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContactoDonante::class);
    }

    // Contacto de donante por id
    public function findByDonante($donanteId) {
        return $this->createQueryBuilder('c')
            ->andWhere('c.donante = :donanteId')
            ->setParameter('donanteId', $donanteId)
            ->getQuery()
            ->getResult();
    }

    // Dirección de donante por id
    public function findDireccionByDonanteId($donanteId)
    {
        return $this->createQueryBuilder('c')
            ->join('c', 'd.contactoDonante')
            ->where('d.id = :donanteId') // Filtramos por ID de Donante
            ->setParameter('donanteId', $donanteId)
            ->select('c.direccion') // Seleccionamos solo la dirección
            ->getQuery()
            ->getSingleScalarResult(); // Obtenemos un solo valor (la dirección)
    }
    
    // CP específico
    public function findDonantesByCodigoPostal($codigoPostal) {
        return $this->createQueryBuilder('c')
            ->join('c.donante', 'd')
            ->where('c.codigoPostal = :codigoPostal')
            ->setParameter('codigoPostal', $codigoPostal)
            ->getQuery()
            ->getResult();
    }
    
    // Ciudad
    public function findDonantesByCiudad($ciudad) {
        return $this->createQueryBuilder('c')
            ->join('c.donante', 'd')
            ->where('c.ciudad = :ciudad')
            ->setParameter('ciudad', $ciudad)
            ->getQuery()
            ->getResult();
    }

    // País España
    public function findDonantesEspana() {
        return $this->createQueryBuilder('c')
            ->join('c.donante', 'd')
            ->where('c.pais = :pais')
            ->setParameter('pais', 'España')
            ->getQuery()
            ->getResult();
    }

    // País Exterior
    public function findDonantesExterior() {
        return $this->createQueryBuilder('c')
            ->join('c.donante', 'd')
            ->where('c.pais != :pais')
            ->setParameter('pais', 'España')
            ->getQuery()
            ->getResult();
    }
    
    //    /**
    //     * @return ContactoDonante[] Returns an array of Contacto objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ContactoDonante
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
