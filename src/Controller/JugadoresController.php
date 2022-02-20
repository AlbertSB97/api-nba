<?php

namespace App\Controller;

use App\Entity\Jugadores;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class JugadoresController extends AbstractController
{
    public function getAllPlayers(){
        $players = $this->getDoctrine()
            ->getManager()
            ->getRepository(Jugadores::class)
            ->findAll();

        return new JsonResponse($players);
    }

    public function getPlayerByName(Request $request)
    {
        $name = $request->get("nombre");
        $nameWithSpace = str_replace("%20", " ", $name);

        $player = $this->getDoctrine()
            ->getManager()
            ->getRepository(Jugadores::class)
            ->findOneBy(["nombre" => $nameWithSpace]);

        return new JsonResponse($player);
    }

    public function getPlayerPhysiqueByName(Request $request)
    {
        $name = $request->get("nombre");
        $nameWithSpace = str_replace("%20", " ", $name);

        $player = $this->getDoctrine()
            ->getManager()
            ->getRepository(Jugadores::class)
            ->findPlayerPhysiqueByName($nameWithSpace);

        $heightDigits = explode("-", $player[0]["altura"]);
        $player[0]["altura"] = $heightDigits[0] * 12 * 2.54 + $heightDigits[1] * 2.54;

        return new JsonResponse($player);
    }
}