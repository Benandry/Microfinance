<?php

namespace App\Controller\Dashboard;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class dashboard extends AbstractController
{
    #[Route('/',name: 'app_dashboard')]
    public function index():Response
    {
        return $this->render('Dashboard/dashboard.html.twig',[
            'controller_name' => 'Dashboard',
        ]);
    }
}
?>