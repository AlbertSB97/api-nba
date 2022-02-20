<?php

namespace App\Controller;

use App\Entity\Equipos;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class EquiposController extends AbstractController
{
    public function getAllTeams()
    {
        $teams = $this->getDoctrine()
            ->getManager()
            ->getRepository(Equipos::class)
            ->findAll();

        return new JsonResponse($teams);
    }

    public function getTeamByName(Request $request)
    {
        $name = $request->get("nombre");

        $team = $this->getDoctrine()
            ->getManager()
            ->getRepository(Equipos::class)
            ->findOneBy(["nombre" => $name]);

        return new JsonResponse($team);
    }

    public function getTeamsPlayers()
    {
        $teams = $this->getDoctrine()
            ->getManager()
            ->getRepository(Equipos::class)
            ->findTeamsPlayers();

        return new JsonResponse($teams);
    }

    public function getTeamPlayersByName(Request $request)
    {
        $name = $request->get("nombre");

        $teams = $this->getDoctrine()
            ->getManager()
            ->getRepository(Equipos::class)
            ->findTeamPlayersByName($name);

        return new JsonResponse($teams);
    }
}