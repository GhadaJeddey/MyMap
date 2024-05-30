<?php

namespace App\Controller;

use App\Entity\Journey;
use App\Repository\JourneyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\Routing\Annotation\Route;

class JourneyController extends AbstractController
{


    #[Route('/user/journey/add', name: 'add_notes', methods: ['POST'])]
    public function addNotes(Request $request, EntityManagerInterface $entityManager): \Symfony\Component\HttpFoundation\Response
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
        } else {
            error_log('No note text received');
        }

        return $this->render('user_space/journey.html.twig', [
            'controller_name' => 'JourneyController',
        ]);
    }


    #[Route('/user/journey/delete', name: 'delete_notes', methods: ['POST'])]
    public function deleteNotes(Request $request, EntityManagerInterface $entityManager): \Symfony\Component\HttpFoundation\Response
    {
        $user = $this->getUser();
        if (!$user) {
            throw new AccessDeniedException('User not logged in or session expired');
        }

        $noteId = $request->request->get('noteId');

        if ($noteId) {
            $journeyRepository = $entityManager->getRepository(Journey::class);
            $note = $journeyRepository->findOneBy(['id' => $noteId, 'user' => $user]);

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

    #[Route("/user/journey", name : "retrieve_notes") ]

    public function retrieveNotes(JourneyRepository $journeyRepository): \Symfony\Component\HttpFoundation\Response
    {
        $userId = $this->getUser()->getId();
        $notesTaken = $journeyRepository->findBy(['user' => $userId]);

        return $this->render('user_space/journey.html.twig', [
            'notesTaken' => $notesTaken,
        ]);
    }


}
