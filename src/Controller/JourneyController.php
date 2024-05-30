<?php

namespace App\Controller;

use App\Entity\Journey;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class JourneyController extends AbstractController
{
    #[Route('/user/journey/add', name: 'add_notes', methods: ['POST'])]
    public function addNotes(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if (!$user) {
            throw new AccessDeniedException('User not logged in or session expired');
        }

        $noteText = $request->request->get('noteText');
        if ($noteText) {
            $noteText = trim($noteText);

            if ($noteText === '')
            {
                $this->addFlash('error', 'Note cannot be empty');
                return $this->redirectToRoute('retrieve_notes');
            }
            $journey = new Journey();
            $journey->setUser($user);
            $journey->setNote($noteText);

            $entityManager->persist($journey);
            $entityManager->flush();

            return $this->redirectToRoute('retrieve_notes');
        } else {
            error_log('No note text received');
            $this->addFlash('error', 'Note cannot be empty');
            return $this->redirectToRoute('retrieve_notes');
        }
    }

    #[Route('/user/journey/delete', name: 'delete_notes', methods: ['POST'])]
    public function deleteNotes(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if (!$user) {
            throw new AccessDeniedException('User not logged in or session expired');
        }

        $noteId = $request->request->get('noteId');

        if ($noteId) {
            $note = $entityManager->getRepository(Journey::class)->findOneBy([
                'id' => $noteId,
                'user' => $user
            ]);

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

    #[Route("/notes", name: 'retrieve_notes', methods: ['GET'])]
    public function retrieveNotes(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if (!$user) {
            throw new AccessDeniedException('User not logged in or session expired');
        }

        $notesTaken = $entityManager->getRepository(Journey::class)->findBy([
            'user' => $user
        ]);

        return $this->render('user_space/journey.html.twig', [
            'notesTaken' => $notesTaken,
        ]);
    }
}
