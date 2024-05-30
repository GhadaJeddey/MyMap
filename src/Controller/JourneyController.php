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
    #[Route("/journey", name : "retrieve_notes") ]

    public function retrieveNotes(JourneyRepository $journeyRepository): \Symfony\Component\HttpFoundation\Response
    {
        $userId = $this->getUser()->getId();
        $notesTaken = $journeyRepository->findBy(['user' => $userId]);

        return $this->render('user_space/journey.html.twig', [
            'notesTaken' => $notesTaken,
        ]);
    }
    #[Route('/journey/add', name: 'add_notes', methods: ['POST'])]
    public function addNotes(Request $request, EntityManagerInterface $entityManager): \Symfony\Component\HttpFoundation\Response
    {
        $user = $this->getUser();
        if (!$user) {
            throw new AccessDeniedException('User not logged in or session expired');
        }

        $noteText = $request->request->get('noteText');

        if ($noteText) {
            $noteText = trim($noteText);

            $journey = new Journey();
            $journey->setUser($user);
            $journey->setNote($noteText);

            $entityManager->persist($journey);
            $entityManager->flush();

            return $this->redirectToRoute('journey');
        }

        return $this->render('user_space/journey.html.twig', [
            'controller_name' => 'JourneyController',
        ]);
    }



}
