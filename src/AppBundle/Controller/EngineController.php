<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Engine;
use AppBundle\Entity\Tank;
use AppBundle\Form\EngineType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class EngineController extends Controller
{
    /**
     * @Route("/engine/{engine}/view", name="engine_page")
     */
    public function engineViewAction(Request $request, Engine $engine)
    {
        $doctrine = $this->getDoctrine();
        $tanks = $doctrine->getRepository(Tank::class)
            ->findAllWithSameEngine($engine);

        return $this->render('engine/engine_view.html.twig', [
            'header' => $engine->getName(),
            'engine' => $engine,
            'tanks' => $tanks,
        ]);
    }

    /**
     * @Route("/engine/add", name="engine_add")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function engineAddAction(Request $request)
    {
        $engine = new Engine();
        $form = $this->createForm(EngineType::class, $engine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($engine);
            $em->flush();

            return $this->redirectToRoute('engine_page', [
                'engine' => $engine->getId(),
            ]);
        }

        return $this->render('engine/engine_edit.html.twig', [
            'header' => 'Add new engine',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/engine/{engine}/edit", name="engine_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function engineEditAction(Request $request, Engine $engine)
    {
        $form = $this->createForm(EngineType::class, $engine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('engine_page', [
                'engine' => $engine->getId(),
            ]);
        }

        return $this->render('engine/engine_edit.html.twig', [
            'header' => 'Edit engine: '.$engine->getName(),
            'form' => $form->createView(),
        ]);
    }
}
