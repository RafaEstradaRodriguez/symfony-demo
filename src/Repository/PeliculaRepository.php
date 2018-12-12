<?php

namespace App\Repository;

use App\Entity\Pelicula;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class PeliculaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Pelicula::class);
    }

    public function findAllWithJoin()
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.tags', 't')
            ->addSelect('t')
            ->getQuery()
            ->getResult();
    }

}
