<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserEditType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_connexion_')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
         if ($this->getUser()) {
             return $this->redirectToRoute('app_dashboard');
         }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        //dd($error);

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }


    #[Route(path: '/users',name : "app_liste_user")]
    public function liste(UserRepository $userRepository): Response
    {
        return $this->render('security/index.html.twig',[
            'listes' => $userRepository->findAll(),
        ]);
    }

    #[Route(path: '/users/{id<[0-9]+>}/edit',name : "app_edit_user")]
    public function edit(Request $request,UserRepository $userRepository,EntityManagerInterface $em, User $user): Response
    {
        $form = $this->createForm(UserEditType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('info',"Modification ".$user->getPrenom()."  effectuée");
            return $this->redirectToRoute('app_liste_user');
        }

        return $this->renderForm('security/edit.html.twig',[
            'listes' => $userRepository->findAll(),
            'form' => $form,
        ]);
    }

    #[Route(path: '/users/{id<[0-9]+>}/show', name: "app_show_user", methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('security/show.html.twig',[
            'users' => $user
        ]);
    }
}
