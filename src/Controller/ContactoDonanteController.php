<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class ContactoDonanteController extends AbstractController
{
    #[Route('/contactodonante', name: 'app_contactodonante')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Hola desde ContactoDonanteController!',
            'path' => 'src/Controller/ContactoDonanteController.php',
        ]);
    }

    #[Route("/donantes-por-codigo-postal/{codigoPostal}", name: "donantes_por_codigo_postal")]
     
    public function donantesPorCodigoPostal($codigoPostal, ContactoDonanteRepository $contactoDonanteRepository): Response
    {
        // Llama a la función del repositorio para obtener los donantes por código postal
        $donantes = $contactoDonanteRepository->findDonantesByCodigoPostal($codigoPostal);
        // ... $donantes se muestran en vista)
        return $this->render('donantes/index.html.twig', [
            'donantes' => $donantes,
        ]);
    }

    #[Route("/donantes-exterior/{pais}", name: "donantes_exterior")]
     
    public function donantesExterior($pais, ContactoDonanteRepository $contactoDonanteRepository): Response
    {
        // Llama a la función del repositorio para obtener los donantes por países en el exterior (no España)
        $donantesExterior = $contactoDonanteRepository->findDonantesExterior($pais);
        // ... $donantes en el exterior se muestran en vista)
        return $this->render('donantes/index.html.twig', [
            'donantes' => $donantes,
        ]);
    }
}