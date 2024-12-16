<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\RestaurantTable;
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
            return $this->redirectToRoute('app_login');
        }

        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $reservationDate = $reservation->getReservationDate();
            $reservationTime = $reservation->getReservationTime();

            if ($reservationDate < new \DateTime('today')) {
                $this->addFlash('error', 'Vous ne pouvez pas réserver pour une date passée.');
                return $this->redirectToRoute('reservation_index');
            }

            $reservation->setCustomerId($user->getCustomerId());

            $availableTables = $entityManager->getRepository(RestaurantTable::class)
                ->findAvailableTables($reservationDate, $reservationTime, $reservation->getGuestCount());

            if (empty($availableTables)) {
                $this->addFlash('error', 'Aucune table disponible pour cette date et heure.');
                return $this->redirectToRoute('reservation_index');
            }

            $reservation->setTableId($availableTables[0]->getId());

            $entityManager->persist($reservation);
            $entityManager->flush();

            $this->addFlash('success', 'Votre réservation a été enregistrée avec succès.');

            return $this->redirectToRoute('reservation_index');
        }

        return $this->render('reservation/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/user/reservations', name: 'user_reservations')]
    public function userReservations(EntityManagerInterface $entityManager, Security $security): Response
    {
        $user = $security->getUser();
        if (!$user) {
            $this->addFlash('error', 'Veuillez vous connecter pour voir vos réservations.');
            return $this->redirectToRoute('app_login');
        }

        $reservations = $entityManager->getRepository(Reservation::class)->findBy(['customerId' => $user->getCustomerId()]);

        return $this->render('reservation/user_reservations.html.twig', [
            'reservations' => $reservations,
        ]);
    }
}