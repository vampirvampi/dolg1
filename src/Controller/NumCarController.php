<?php

namespace App\Controller;

use App\Entity\NumCar;
use App\Form\NumCarType;
use App\Repository\NumCarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/num/car")
 */
class NumCarController extends AbstractController
{
    /**
     * @Route("/", name="num_car_index", methods={"GET"})
     */
    public function index(NumCarRepository $numCarRepository): Response
    {
        return $this->render('num_car/index.html.twig', [
            'num_cars' => $numCarRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="num_car_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $numCar = new NumCar();
        $form = $this->createForm(NumCarType::class, $numCar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($numCar);
            $entityManager->flush();

            return $this->redirectToRoute('num_car_index');
        }

        return $this->render('num_car/new.html.twig', [
            'num_car' => $numCar,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="num_car_show", methods={"GET"})
     */
    public function show(NumCar $numCar): Response
    {
        return $this->render('num_car/show.html.twig', [
            'num_car' => $numCar,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="num_car_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, NumCar $numCar): Response
    {
        $form = $this->createForm(NumCarType::class, $numCar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('num_car_index');
        }

        return $this->render('num_car/edit.html.twig', [
            'num_car' => $numCar,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="num_car_delete", methods={"DELETE"})
     */
    public function delete(Request $request, NumCar $numCar): Response
    {
        if ($this->isCsrfTokenValid('delete'.$numCar->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($numCar);
            $entityManager->flush();
        }

        return $this->redirectToRoute('num_car_index');
    }
}
