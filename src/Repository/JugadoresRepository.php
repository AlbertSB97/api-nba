<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class JugadoresRepository extends EntityRepository
{
    public function findPlayerPhysiqueByName($name)
    {
        $dql = "SELECT p.nombre, TRUNCATE((p.peso * 0.453592), 2) peso, p.altura, p.posicion 
        FROM App:Jugadores p WHERE p.nombre = :nombre";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter("nombre", $name);

        return $query->getArrayResult();
    }
}