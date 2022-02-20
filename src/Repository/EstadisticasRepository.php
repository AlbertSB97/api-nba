<?php

namespace App\Repository;

use \Doctrine\ORM\EntityRepository;

class EstadisticasRepository extends EntityRepository
{
    public function findStatisticsByName($name){
        $dql = "SELECT s.temporada, s.puntosPorPartido, s.asistenciasPorPartido, s.taponesPorPartido, s.rebotesPorPartido FROM App:Estadisticas s 
        INNER JOIN App:Jugadores p WITH p.codigo = s.jugador
        WHERE p.nombre = :nombre";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter("nombre", $name);

        return $query->getArrayResult();
    }

    public function findStatisticsByNameAvg($name)
    {
        $dql = "SELECT TRUNCATE(AVG(s.puntosPorPartido), 2) mediaPuntosPorPartido, TRUNCATE(AVG(s.asistenciasPorPartido), 2) mediaAsistenciasPorPartido, TRUNCATE(AVG(s.taponesPorPartido), 2) mediaTaponesPorPartido, TRUNCATE(AVG(s.rebotesPorPartido), 2) mediaRebotesPorPartido FROM App:Estadisticas s
        INNER JOIN App:Jugadores p WITH p.codigo = s.jugador
        WHERE p.nombre = :nombre";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter("nombre", $name);

        return $query->getArrayResult();
    }
}