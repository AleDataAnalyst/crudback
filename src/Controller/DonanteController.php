<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class DonanteController extends AbstractController
{
    #[Route('/donante', name: 'app_donante')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Hola desde DonanteController!',
            'path' => 'src/Controller/DonanteController.php',
        ]);
    }

    // Obtener un donante por su ID
    #[Route("/donante/{id}", name: "donante_id")]
     
    public function donanteId($id, DonanteRepository $donanteRepository): Response
    {
        // Llama a la función del repositorio para obtener donante por id
        $donanteId = $donanteRepository->find($id);
        return $this->render('donante-id/index.html.twig', [
            'donante' => $donanteId,
        ]);
    }

    #[Route("/donante/{apellido}", name: "donante_por_apellido")]
    public function findByApellido(DonanteRepository $donanteRepository, $apellido)
    {
        $donanteApellido = $donanteRepository->findByApellido($apellido);
        // Respuesta JSON con apellido del donante
        return $this->json([
            'donante' => $donanteApellido,
        ]);
    }

    #[Route("/donante/{email}", name: "donante_por_email")]
    public function findByEmail(DonanteRepository $donanteRepository, $email)
    {
        $donanteEmail = $donanteRepository->findByEmail($email);
        return $this->json([
            'donante' => $donanteEmail,
        ]);
    }
}
