<?php

namespace AppBundle\Controller;

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
     * @Route("/tank/{tank}", name="tank_page")
     */
    public function tankAction(Request $request, Tank $tank)
    {
        return $this->render('tank/tank.html.twig', [
            'header' => $tank->getName(),
            'tank' => $tank,
            'guns' => $tank->getGuns(),
        ]);
    }

    /**
     * @Route("/tank/{tank}/edit", name="tank_edit")
     * @Method({"GET", "POST"})
     */
    public function tankEditAction(Request $request, Tank $tank)
    {
        $allGuns = $this->getDoctrine()->getRepository(Gun::class)->findAll();
        $form = $this->createForm(TankType::class, $tank, [
            'all_guns' => $allGuns,
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

