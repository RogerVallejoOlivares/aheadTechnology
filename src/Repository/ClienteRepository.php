<?php

namespace App\Repository;

use App\Entity\Cliente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cliente|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cliente|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cliente[]    findAll()
 * @method Cliente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClienteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cliente::class);
    }

    /**
     * Select del cliente con el nombre y el email
     * Pasamos a Lower tanto la variable como los datos de la BBDD, NO RECOMENDADO, hecho para facilitar las pruebas manuales
     * Recibiremos un Cliente o null
     * @param $nombre
     * @param $email
     * @return Cliente|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findByNameEmail($nombre, $email): ?Cliente
    {
        return $this->createQueryBuilder('c')
            ->andWhere('LOWER(c.Nombre) = :nombre')
            ->setParameter('nombre', strtolower($nombre))
            ->andWhere('LOWER(c.Email) = :email')
            ->setParameter('email', strtolower($email))
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

}
