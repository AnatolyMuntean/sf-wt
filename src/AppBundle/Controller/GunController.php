<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Gun;
use AppBundle\Entity\Tank;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
        $form = $this->createFormBuilder($gun)
            ->add('name', TextType::class)
            ->add('shell', TextType::class)
            ->add('caliber', IntegerType::class)
            ->add('elevationmin', NumberType::class)
            ->add('elevationmax', NumberType::class)
            ->add('traverse', IntegerType::class)
            ->add('Save', SubmitType::class, [
                'label' => 'Save',
            ])
            ->getForm();

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

