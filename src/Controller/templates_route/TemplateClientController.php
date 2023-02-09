<?php

namespace App\Controller\templates_route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TemplateClientController extends AbstractController
{
    // Templates client
    // client individuel
    #[Route('/template/client', name: 'app_template_client')]
    public function index(): Response
    {
        return $this->render('template/client_template.html.twig');
    }
    // approbation client
    #[Route('/template/approbation',name: 'app_template_approbation')]
    public function approbation(): Response
    {
        return $this->render('template/approbation_template.html.twig');
    }

     // Client Mobile
     #[Route('/template/mobile',name: 'app_mobile_template')]
     public function Mobile():Response
     {
         return $this->render('/template/mobile_template.html.twig');
     }

    // transfert produit
    #[Route('/template/transfertProduit',name:'app_templates_transfert_produit')]
    public function transfert() : Response
    {
        return $this->render('template/transfert.html.twig');
    }
    // groupe
    #[Route('/template/groupe',name: 'app_groupe')]
    public function groupe():Response
    {
        return $this->render('template/groupe_template.html.twig');
    }
    // Template Epargne
    // Compte epargne
    #[Route('/template/compteepargne',name: 'app_compte_epargne')]
    public function compteepargne():Response
    {
        return $this->render('template/compteepargne_template.html.twig');
    }
    // Type epargne
    #[Route('/template/typeepargne',name: 'app_type_epargne')]
    public function typeepargne():Response
    {
        return $this->render('/template/typeepargne_templates.html.twig');
    }
}
