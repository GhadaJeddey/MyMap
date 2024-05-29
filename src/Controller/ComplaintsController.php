<?php

namespace App\Controller;

use App\Entity\Complaints;
use App\Form\ComplaintsFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ComplaintsController extends AbstractController
{

    #[Route('/home', name: 'complaints')]

    public function complaint(Request $request, EntityManagerInterface $entityManager): Response
    {
        $complaint = new Complaints();
        $form = $this->createForm(ComplaintsFormType::class, $complaint);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $complaint->setComplaint($complaint->getComplaint());
            $complaint->setUsername($complaint->getUsername());
            $complaint->setEmail($complaint->getEmail());

            $entityManager->persist($complaint);
            $entityManager->flush();

            return $this->redirectToRoute('map');
        }

        return $this->render('home_page/home.html.twig', [
            'complaint' => $complaint,
            'complaintForm' => $form->createView(),
        ]);
    }
}



