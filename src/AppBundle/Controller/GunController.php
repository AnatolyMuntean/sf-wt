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
     * @Route("/gun/{gun}/view", name="gun_page")
     */
    public function gunViewAction(Request $request, Gun $gun)
    {
        $tanks = $this->get('doctrine')->getRepository(Tank::class)
            ->findAllWithSameGun($gun);

        return $this->render('gun/gun_view.html.twig', [
            'header' => $gun->getName(),
            'gun' => $gun,
            'tanks' => $tanks,
        ]);
    }

    /**
     * @Route("/gun/add", name="gun_add")
     * @Method({"GET", "POST"})
     */
    public function gunAddAction(Request $request)
    {
        $gun = new Gun();
        $form = $this->createForm(GunType::class, $gun);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($gun);
            $em->flush();

            return $this->redirectToRoute('gun_page', [
               'gun' => $gun->getId(),
            ]);
        }

        return $this->render('gun/gun_edit.html.twig', [
            'header' => 'Add new gun',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/gun/{gun}/edit", name="gun_edit")
     * @Method({"GET", "POST"})
     */
    public function gunEditAction(Request $request, Gun $gun)
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

