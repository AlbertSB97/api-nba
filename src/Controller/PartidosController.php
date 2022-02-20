<?php

namespace App\Controller;

use App\Entity\Partidos;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PartidosController extends AbstractController
{
    public function getResultsHomeByName(Request $request)
    {
        $name = $request->get("nombre");

        $results = $this->getDoctrine()
            ->getManager()
            ->getRepository(Partidos::class)
            ->findBy(["equipoLocal" => $name]);

        return new JsonResponse($results);
    }

    public function getResultsAwayByName(Request $request)
    {
        $name = $request->get("nombre");

        $results = $this->getDoctrine()
            ->getManager()
            ->getRepository(Partidos::class)
            ->findBy(["equipoVisitante" => $name]);

        return new JsonResponse($results);
    }

    public function getResultsHomeByNameAvg(Request $request)
    {
        $name = $request->get("nombre");

        $results = $this->getDoctrine()
            ->getManager()
            ->getRepository(Partidos::class)
            ->findResultsHomeByNameAvg($name);

        return new JsonResponse($results);
    }

    public function getResultsAwayByNameAvg(Request $request)
    {
        $name = $request->get("nombre");

        $results = $this->getDoctrine()
            ->getManager()
            ->getRepository(Partidos::class)
            ->findResultsAwayByNameAvg($name);

        return new JsonResponse($results);
    }
}