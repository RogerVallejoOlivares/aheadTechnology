<?php

namespace App\Repository;

use App\Entity\DatosBancarios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DatosBancarios|null find($id, $lockMode = null, $lockVersion = null)
 * @method DatosBancarios|null findOneBy(array $criteria, array $orderBy = null)
 * @method DatosBancarios[]    findAll()
 * @method DatosBancarios[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DatosBancariosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DatosBancarios::class);
    }

    /*
    public function findOneBySomeField($value): ?DatosBancarios
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.iban = :iban')
            ->setParameter('iban', $iban)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
