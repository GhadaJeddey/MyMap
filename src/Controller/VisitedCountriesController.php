<?php

namespace App\Controller;

use App\Entity\VisitedCountries;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VisitedCountriesController extends AbstractController
{
    #[Route('/user', name: 'add_visited_countries')]
    public function addVisitedCountry(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user =$this->getUser();
        if (!$user) {
            throw new AccessDeniedException('User not logged in or session expired');
        }
        $countryName = $request->request->get('countryName');

        if ($request->isMethod('POST') && $countryName) {
            $countryName = trim($countryName);

            $visitedCountry = new VisitedCountries();
            $visitedCountry->setUser($user);
            $visitedCountry->setCountryName($countryName);
            $user->setNbVisits($user->getNbVisits() + 1);
            $entityManager->persist($visitedCountry);
            $entityManager->flush();

            return $this->redirectToRoute('map');
        }

        return $this->render('user_space/maptracker.html.twig', [
            'controller_name' => 'VisitedCountriesController',
        ]);
    }
    #[Route('/user', name: 'remove_visited_countries')]
    public function removeVisitedCountry(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if (!$user) {
            throw new AccessDeniedException('User not logged in or session expired');
        }
        $countryName = $request->request->get('countryName');

        if ($request->isMethod('POST') && $countryName) {
            $countryName = trim($countryName);

            $visitedCountry = $entityManager->getRepository(VisitedCountries::class)->findOneBy([
                'user' => $user,
                'countryName' => $countryName,
            ]);

            if ($visitedCountry) {
                $entityManager->remove($visitedCountry);
                $entityManager->flush();
                $user->setNbVisits($user->getNbVisits() - 1);
            }

            return $this->redirectToRoute('map');
        }

        return $this->render('user_space/maptracker.html.twig', [
            'controller_name' => 'VisitedCountriesController',
        ]);
    }
    #[Route('/map', name: 'map')]
    public function map(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if (!$user) {
            throw new AccessDeniedException('User not logged in or session expired');
        }

        $visitedCountries = $entityManager->getRepository(VisitedCountries::class)->findBy([
            'user' => $user,
        ]);

        $visitedCountryNames = [];
        foreach ($visitedCountries as $visitedCountry) {
            $visitedCountryNames[] = $visitedCountry->getCountryName();
        }

        return $this->render('user_space/maptracker.html.twig', [
            'visitedCountryNames' => $visitedCountryNames,
        ]);

    }
}
