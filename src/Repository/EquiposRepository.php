<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class EquiposRepository extends EntityRepository
{
    public function findTeamsPlayers()
    {
        $dql = "SELECT t.nombre, t.ciudad, t.conferencia, t.division, GROUP_CONCAT(p.nombre) jugadores FROM App:Equipos t 
        INNER JOIN App:Jugadores p WITH p.nombreEquipo = t.nombre
        GROUP BY t.nombre";
        $query = $this->getEntityManager()->createQuery($dql);

        return $query->getArrayResult();
    }

    public function findTeamPlayersByName($name)
    {
        $dql = "SELECT t.nombre, t.ciudad, t.conferencia, t.division, GROUP_CONCAT(p.nombre) jugadores FROM App:Equipos t 
        INNER JOIN App:Jugadores p WITH p.nombreEquipo = t.nombre
        WHERE t.nombre = :nombre
        GROUP BY t.nombre";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter("nombre", $name);

        return $query->getArrayResult();
    }
}