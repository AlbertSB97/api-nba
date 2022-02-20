<?php

namespace App\Controller;

use App\Entity\Estadisticas;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class EstadisticasController extends AbstractController
{
    public function getStatisticsByName(Request $request)
    {
        $name = $request->get("nombre");
        $nameWithSpace = str_replace("%20", " ", $name);

        $seasons = $this->getDoctrine()
            ->getManager()
            ->getRepository(Estadisticas::class)
            ->findStatisticsByName($nameWithSpace);

        foreach ($seasons as $season) {
            $playerSeasons[$season["temporada"]] = [
                "puntosPorPartido" => $season["puntosPorPartido"],
                "asistenciasPorPartido" => $season["asistenciasPorPartido"],
                "taponesPorPartido" => $season["taponesPorPartido"],
                "rebotesPorPartido" => $season["rebotesPorPartido"]
            ];
        }
        $playerStats[$name] = $playerSeasons;

        return new JsonResponse($playerStats);
    }

    public function getStatisticsByNameAvg(Request $request)
    {
        $name = $request->get("nombre");
        $nameWithSpace = str_replace("%20", " ", $name);

        $playerStatsAvg = $this->getDoctrine()
            ->getManager()
            ->getRepository(Estadisticas::class)
            ->findStatisticsByNameAvg($nameWithSpace);

        $stats[$nameWithSpace] = $playerStatsAvg[0];

        return new JsonResponse($stats);
    }
}