<?php

namespace App\Repository;

use App\Entity\Persona;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Persona|null find($id, $lockMode = null, $lockVersion = null)
 * @method Persona|null findOneBy(array $criteria, array $orderBy = null)
 * @method Persona[]    findAll()
 * @method Persona[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Persona::class);
    }

    public function findMayoresEdad()
    {
        // Por hacer
    }

    public function find5MujeresMasMayores()
    {
        // Por hacer
    }

    public function findPersonasRegistradasEnlaUltimaSemana()
    {
        // Por hacer
    }

    public function numeroDePersonasMayoresde65()
    {
        // Por hacer
    }
}
