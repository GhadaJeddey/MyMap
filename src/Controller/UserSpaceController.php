<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class UserSpaceController extends AbstractController
{

    /**
     * @IsGranted("ROLE_USER")
     */


    #[Route('/user', name: 'map')]
    public function space(): Response
    {
        return $this->render('user_space/maptracker.html.twig', [
            'controller_name' => 'UserSpaceController',
        ]);
    }
    #[Route('/user/journey', name: 'journey')]
    public function journey(): Response
    {
        return $this->render('user_space/journey.html.twig', [
            'controller_name' => 'UserSpaceController',
        ]);
    }
}
