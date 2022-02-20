<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class PartidosRepository extends EntityRepository
{
    public function findResultsHomeByNameAvg($name)
    {
        $dql = "SELECT TRUNCATE(AVG(m.puntosVisitante), 2) mediaPuntosRecibidos FROM App:Partidos m 
        INNER JOIN App:Equipos t WITH m.equipoLocal = t.nombre
        WHERE t.nombre = :nombre";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter("nombre", $name);

        return $query->getArrayResult();
    }

    public function findResultsAwayByNameAvg($name)
    {
        $dql = "SELECT TRUNCATE(AVG(m.puntosLocal), 2) mediaPuntosRecibidos FROM App:Partidos m
        INNER JOIN App:Equipos t WITH m.equipoVisitante = t.nombre
        WHERE t.nombre = :nombre";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter("nombre", $name);

        return $query->getArrayResult();
    }
}