<?php

namespace App\Controller;

use App\Entity\Otel;
use App\Form\OtelType;
use App\Repository\OtelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/otel")
 */
class OtelController extends AbstractController
{
    /**
     * @Route("/", name="otel_index", methods={"GET"})
     */
    public function index(OtelRepository $otelRepository): Response
    {
        return $this->render('otel/index.html.twig', [
            'otels' => $otelRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="otel_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $otel = new Otel();
        $form = $this->createForm(OtelType::class, $otel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($otel);
            $entityManager->flush();

            return $this->redirectToRoute('otel_index');
        }

        return $this->render('otel/new.html.twig', [
            'otel' => $otel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="otel_show", methods={"GET"})
     */
    public function show(Otel $otel): Response
    {
        return $this->render('otel/show.html.twig', [
            'otel' => $otel,
            'rooms' => $otel->getRooms(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="otel_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Otel $otel): Response
    {
        $form = $this->createForm(OtelType::class, $otel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('otel_index');
        }

        return $this->render('otel/edit.html.twig', [
            'otel' => $otel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="otel_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Otel $otel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$otel->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($otel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('otel_index');
    }
}
