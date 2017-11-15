<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Gun;
use AppBundle\Entity\Tank;
use AppBundle\Form\GunType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GunController extends Controller
{
    /**
     * @Route("/gun/{gun}", name="gun_page")
     */
    public function gunAction(Request $request, Gun $gun)
    {
        $tanks = $this->get('doctrine')->getRepository(Tank::class)
            ->findAllArmedWith($gun);

        return $this->render('gun/gun.html.twig', [
            'header' => $gun->getName(),
            'gun' => $gun,
            'tanks' => $tanks,
        ]);
    }

    /**
     * @Route("/gun/{gun}/edit", name="gun_edit")
     * @Method({"GET", "POST"})
     */
    public function getEditAction(Request $request, Gun $gun)
    {
        $form = $this->createForm(GunType::class, $gun);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Gun $gun */
            $gun = $form->getData();

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('gun_page', [
                'gun' => $gun->getId(),
            ]);
        }

        return $this->render('gun/gun_edit.html.twig', [
            'header' => 'Edit gun: '.$gun->getName(),
            'form' => $form->createView(),
        ]);
    }
}

