<?php

namespace App\Controller;

use App\Repository\ComplaintsRepository;
use App\Repository\UserRepository;
use doctrine\dbal\exception;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\DBAL\Connection;


class AdminSpaceController extends AbstractController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     */

    #[Route('/admin', name: 'dashboard')]
    public function numbers(Connection $connection) : Response
    {
        try {
            // Fetching number of users
            $usersResult = $connection->executeQuery('SELECT COUNT(*) AS count FROM user WHERE roles LIKE \'%ROLE_USER%\'');
            $usersCount = $usersResult->fetchOne(); // fetchOne() fetches the next row's first column value

            // Fetching number of admins
            $adminsResult = $connection->executeQuery('SELECT COUNT(*) AS count FROM user WHERE roles LIKE \'%ROLE_ADMIN%\'');
            $adminsCount = $adminsResult->fetchOne();

            // Fetching number of forms
            $formsResult = $connection->executeQuery('SELECT COUNT(*) AS count FROM complaints');
            $formsCount = $formsResult->fetchOne();

            return $this->render('admin_space/dashboard.html.twig', [
                'usersCount' => $usersCount,
                'adminsCount' => $adminsCount,
                'formsCount' => $formsCount,
            ]);
        } catch (Exception $e) {
            error_log($e->getMessage());
            return new Response('An error occurred: ' . $e->getMessage()); // Include the error message in the response for better debugging.
        }
    }


    #[Route('/admin/users', name: 'users')]
    public function usersTable(UserRepository $userRepository): Response
    {
        $users = $userRepository->findBy(['roles' => 'ROLE_USER']);
        dump($users);
        return $this->render('admin_space/users.html.twig', [
            'controller_name' => 'AdminSpaceController',
            'users' => $users,
        ]);
    }
    #[Route('/admin/users', name: 'admins')]
    public function adminsTable(UserRepository $userRepository): Response
    {
        $admins = $userRepository->findBy(['roles' => 'ROLE_ADMIN']);
        dump($admins);
        return $this->render('admin_space/users.html.twig', [
            'controller_name' => 'AdminSpaceController',
            'admins' => $admins,
        ]);
    }

    #[Route('/admin/forms', name: 'forms')]
    public function formsTable(ComplaintsRepository $complaintsRepository): Response
    {
        $complaints = $complaintsRepository->findAll();

        return $this->render('admin_space/forms.html.twig', [
            'controller_name' => 'AdminSpaceController',
            'complaints' => $complaints,
        ]);
    }

    #[Route('/admin/users/deleteUser/{id}', name: 'delete_user')]
    public function deleteUser(int $id, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {

        $user = $userRepository->find($id);

        if ($user) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('users');
    }


    #[Route('/admin/users/deleteAdmin/{id}', name: 'delete_admin')]
    public function deleteAdmin(int $id, UserRepository $userRepository , EntityManagerInterface $entityManager): Response
    {
        $user = $userRepository->find($id);

        if ($user) {

            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admins');
    }



    #[Route('/admin/fomrs/deleteForm/{id}', name: 'delete_form')]
    public function deleteForm(int $id, ComplaintsRepository $formRepository , EntityManagerInterface $entityManager): Response
    {
        $form = $formRepository->find($id);

        if ($form) {

            $entityManager->remove($form);
            $entityManager->flush();
        }
        return $this->redirectToRoute('forms');
    }

}
