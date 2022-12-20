<?php

namespace App\Controller\Credit;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DecaissementCreditController extends AbstractController
{

    #[Route('/decaissement/credit', name: 'app_decaissement_credit')]
    public function index(Request $request): Response
    {
        $codecredit  = $request->request->get('codecredit');
        if($codecredit == null){
            return $this->render('Module_credit/decaissement/index.html.twig');
        }else{
           dd($codecredit);
        }
    }
}