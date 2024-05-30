<?php

namespace App\Controller;

use App\Entity\Journey;
use http\Client\Curl\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class JourneyController extends AbstractController
{


    #[Route('/user/journey/add', name: 'add_notes')]
    public function addNotes(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if (!$user) {
            throw new AccessDeniedException('User not logged in or session expired');
        }

        $noteText = $request->request->get('noteText');
        if ($noteText) {
            $noteText = trim($noteText);

            error_log('Received note text: ' . $noteText);

            $journey = new Journey();
            $journey->setUser($user);
            $journey->setNote($noteText);

            $entityManager->persist($journey);
            $entityManager->flush();

            return $this->redirectToRoute('retrieve_notes');
        }

        return $this->render('user_space/journey.html.twig', [
            'controller_name' => 'JourneyController',
        ]);
    }


    #[Route('/user/journey/delete', name: 'delete_notes')]
    public function deleteNotes(Request $request, EntityManagerInterface $entityManager):Response
    {
        $user = $this->getUser();
        if (!$user) {
            throw new AccessDeniedException('User not logged in or session expired');
        }

        $noteId = $request->request->get('noteId');

        if ($request->isMethod('POST') && $noteId) {
            $note= $entityManager->getRepository(Journey::class)->findOneBy([
                'id' => $noteId,
                'user' => $user]);

            if ($note) {
                $entityManager->remove($note);
                $entityManager->flush();
            }

            return $this->redirectToRoute('retrieve_notes');
        }

        return $this->render('user_space/journey.html.twig', [
            'controller_name' => 'JourneyController',
        ]);
    }

    #[Route("/notes", name : "retrieve_notes") ]

    public function retrieveNotes(EntityManagerInterface $entityManager): Response
    {
        $userId = $this->getUser()->getId();
        $notesTaken = $entityManager->getRepository(Journey::class)->findBy([
            'user' => $userId
        ]);

        return $this->render('user_space/journey.html.twig', [
            'notesTaken' => $notesTaken,
        ]);
    }
}
