<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminSpaceController extends AbstractController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     */

    #[Route('/admin', name: 'dashboard')]
    public function space(): Response
    {
        return $this->render('admin_space/dashboard.html.twig', [
            'controller_name' => 'AdminSpaceController',
        ]);
    }


    #[Route('/admin/users', name: 'users')]
    public function users(): Response
    {
        $users = [
            ['id' => 1, 'username' => 'user1', 'email' => 'user1@example.com', 'date' => '2000-01-01'],
            ['id' => 2, 'username' => 'user2', 'email' => 'user2@example.com', 'date' => '2000-01-02'],
            // Fetch more users here...
        ];

        return $this->render('admin_space/users.html.twig', [
            'controller_name' => 'AdminSpaceController',
            'users' => $users,
        ]);
    }


    #[Route('/admin/admins', name: 'admins')]
    public function admins(): Response
    {
        $admins = [
            ['id' => 1, 'username' => 'admin1', 'email' => 'admin1@example.com', 'date' => '2000-01-01'],
            ['id' => 2, 'username' => 'admin2', 'email' => 'admin2@example.com', 'date' => '2000-01-02'],
            // Fetch more admins here...
        ];

        return $this->render('admin_space/admins.html.twig', [
            'controller_name' => 'AdminSpaceController',
            'admins' => $admins,
        ]);
    }
    #[Route('/admin/forms', name: 'forms')]
    public function forms(): Response
    {
        $complaints = [
            ['id' => 1, 'username' => 'user1', 'email' => 'user1@example.com', 'complaint' => 'Complaint 1'],
            ['id' => 2, 'username' => 'user2', 'email' => 'user2@example.com', 'complaint' => 'Complaint 2'],
            // Add more complaints here...
        ];

        return $this->render('admin_space/forms.html.twig', [
            'controller_name' => 'AdminSpaceController',
            'complaints' => $complaints,
        ]);
    }


}

?>