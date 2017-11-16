<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Engine;
use AppBundle\Entity\Gun;
use AppBundle\Entity\Tank;
use AppBundle\Form\TankType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TankController extends Controller
{
    /**
     * @Route("/tank/{tank}/view", name="tank_page")
     */
    public function tankViewAction(Request $request, Tank $tank)
    {
        return $this->render('tank/tank.html.twig', [
            'header' => $tank->getName(),
            'tank' => $tank,
        ]);
    }

    /**
     * @Route("/tank/add", name="tank_add")
     * @Method({"GET", "POST"})
     */
    public function tankAddAction(Request $request)
    {
        $doctrine = $this->getDoctrine();
        $tank = new Tank();
        $allGuns = $doctrine->getRepository(Gun::class)->findAll();
        $allEngines = $doctrine->getRepository(Engine::class)->findAll();
        $form = $this->createForm(TankType::class, $tank, [
            'all_guns' => $allGuns,
            'all_engines' => $allEngines,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tank);
            $em->flush();

            return $this->redirectToRoute('tank_page', [
                'tank' => $tank->getId(),
            ]);
        }

        return $this->render('tank/tank_edit.html.twig', [
            'header' => 'Add new tank',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/tank/{tank}/edit", name="tank_edit")
     * @Method({"GET", "POST"})
     */
    public function tankEditAction(Request $request, Tank $tank)
    {
        $doctrine = $this->getDoctrine();
        $allGuns = $doctrine->getRepository(Gun::class)->findAll();
        $allEngines = $doctrine->getRepository(Engine::class)->findAll();
        $form = $this->createForm(TankType::class, $tank, [
            'all_guns' => $allGuns,
            'all_engines' => $allEngines,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Tank $tank */
            $tank = $form->getData();

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('tank_page', [
                'tank' => $tank->getId(),
            ]);
        }

        return $this->render('tank/tank_edit.html.twig', [
            'header' => 'Edit tank: ' . $tank->getName(),
            'form' => $form->createView(),
        ]);
    }
}

