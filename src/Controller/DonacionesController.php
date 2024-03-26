<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class DonacionesController extends AbstractController
{
    #[Route('/donaciones', name: 'app_donaciones')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Hola desde DonacionesController!',
            'path' => 'src/Controller/DonacionesController.php',
        ]);
    }
}
