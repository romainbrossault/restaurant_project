<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class ReservationController extends AbstractController
{
    #[Route(path: '/reservation', name: 'reservation_index')]
    public function index(Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {
        $user = $security->getUser();
        if (!$user) {
            $this->addFlash('error', 'Veuillez vous connecter pour réserver. <a href="'.$this->generateUrl('app_login').'">Se connecter</a>');
        }

        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $reservation->setCustomerId($user->getId());

            $entityManager->persist($reservation);
            $entityManager->flush();

            $this->addFlash('success', 'Votre réservation a été enregistrée avec succès.');

            return $this->redirectToRoute('reservation_index');
        }

        return $this->render('reservation/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}