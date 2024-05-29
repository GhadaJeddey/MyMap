<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class HomePageController extends AbstractController
{
    #[Route('/home', name: 'home_page')]
    public function homePage(): Response
    {
        return $this->render('home_page/home.html.twig', [
            'controller_name' => 'HomePageController',
        ]);
    }

    #[Route('/home/login', name: 'login')]
    public function login() : Response
    {
        return $this->render('security/login.html.twig', [
            'controller_name' => 'HomePageController',
        ]);
    }
}
