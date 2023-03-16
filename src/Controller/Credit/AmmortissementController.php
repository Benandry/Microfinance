<?php

namespace App\Controller\Credit;

use App\Repository\DemandeCreditRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AmmortissementController extends AbstractController
{
    #[Route('/ammortissement/{codecredit}', name: 'app_ammortissement')]
    public function index(DemandeCreditRepository $demandeCreditRepository,$codecredit)
    {
        $demande=$demandeCreditRepository->Ammortissement($codecredit);

        return new JsonResponse($demande);
        // return $this->json([
        //     'message' => 'Welcome to your new controller!',
        //     'path' => 'src/Controller/AmmortissementController.php',
        // ]);
    }
}
