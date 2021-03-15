<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Room;
use App\Entity\Otel;
use App\Entity\User;
use App\Form\BookingType;
use Carbon\Carbon;
use App\Repository\BookingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



/**
 * @Route("/booking")
 */
class BookingController extends AbstractController
{
    /**
     * @Route("/", name="booking_index", methods={"GET"})
     */
    public function index(BookingRepository $bookingRepository): Response
    {
        $user = $this->getUser();
        return $this->render('booking/index.html.twig', [
            'bookings' => $user->getBookings(),

        ]);
    }

    /**
     * @Route("/new/{id}", name="booking_new", methods={"GET","POST"})
     */
    public function new(Request $request, Room $room, BookingRepository $bookingRepository ): Response
    {
        $booking = new Booking();
        $booking->setRoom($room);
        $booking->setOtel($room->getOtel());
        $booking->setGuestsNum($room->getNumberOfGuests());
        $user = $this->getUser();
        $booking->setUser($user);
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);
        $datein=$form["date_in"]->getData();
        $dateout=$form["date_out"]->getData();
        $uniq=$bookingRepository->findByDate($booking);
        if($form->isSubmitted()){
        $datefrom=$booking->getDateIn();
        $dateto=$booking->getDateOut();
        $datediff = $dateout->diff($datein);
        $datenumb = $datediff->format('%a');
        $price=$booking->getRoom()->getPrice();
        $booking->setFinalPrice($datenumb*$price);
        }
        if ($form->isSubmitted() && $form->isValid() && $uniq==false) {
            if($datein< $dateout) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($booking);
                $entityManager->flush();

                return $this->redirectToRoute('booking_index');
            }

            else{
                $this->addFlash(
                    'notice',
                    'Укажите корректно даты!'
                );
            }


        }
        if ($uniq==true){
            $this->addFlash(
                'mistake',
                'На эти даты комната занята, укажите другие даты или выберете другую комнату!'
            );
        }




        return $this->render('booking/new.html.twig', [
            'booking' => $booking,
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/{id}", name="booking_show", methods={"GET"})
     */
    public function show(Booking $booking): Response
    {
        return $this->render('booking/show.html.twig', [
            'booking' => $booking,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="booking_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Booking $booking): Response
    {
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('booking_index');
        }

        return $this->render('booking/edit.html.twig', [
            'booking' => $booking,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="booking_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Booking $booking): Response
    {
        if ($this->isCsrfTokenValid('delete'.$booking->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($booking);
            $entityManager->flush();
        }

        return $this->redirectToRoute('booking_index');
    }





}
