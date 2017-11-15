<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Gun;
use AppBundle\Entity\Tank;
use AppBundle\Form\ProductionType;
use AppBundle\Form\SizeType;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
        $form = $this->createFormBuilder($tank)
            ->add('name', TextType::class)
            ->add('weight', IntegerType::class)
            ->add('original_name', TextType::class)
            ->add('production', ProductionType::class)
            ->add('guns', EntityType::class, [
                'multiple' => true,
                'choices' => $allGuns,
                'choice_label' => function ($gun) {
                    /** @var Gun $gun */
                    return $gun->getName();
                },
                'class' => Gun::class,
            ])
            ->add('size', SizeType::class)
            ->add('Save', SubmitType::class, [
                'label' => 'Save',
            ])
            ->getForm();

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

