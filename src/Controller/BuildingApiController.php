<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Building;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class BuildingApiController extends AbstractController
{
    /**
     * @Route("/api/buildings", name="api_buildings")
     *
     * @return JsonResponse
     */
    public function index()
    {
        $buildings = $this->getDoctrine()
                        ->getRepository(Building::class)
                        ->findAllWithArray();

        return new JsonResponse($buildings);
    }

    /**
     * @Route("/api/building/{id}/apartments")
     *
     * @param $id
     * @return JsonResponse
     */
    public function showApartments($id) {
        $apartments = $this->getDoctrine(Building::class)
                        ->getRepository(Building::class)
                        ->findOneByIdJoinedToBuilding($id);
            
        
        return new JsonResponse($apartments);
    }
}
