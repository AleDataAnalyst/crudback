<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class ProyectosController extends AbstractController
{
    #[Route('/proyectos', name: 'app_proyectos')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Hola desde ProyectosController!',
            'path' => 'src/Controller/ProyectosController.php',
        ]);
    }
}
