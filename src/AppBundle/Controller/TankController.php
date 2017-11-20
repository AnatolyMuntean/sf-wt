<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Engine;
use AppBundle\Entity\Gun;
use AppBundle\Entity\Tank;
use AppBundle\Form\TankType;
use AppBundle\Services\FileUploaderService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class TankController extends Controller
{
    const COMPARE_TANKS = 'compare-tanks';
    const COMPARE_LIMIT = 3;

    /**
     * @Route("/tank/{tank}/view", name="tank_page")
     */
    public function tankViewAction(Request $request, Tank $tank)
    {
        return $this->render('tank/tank_view.html.twig', [
            'header' => $tank->getName(),
            'tank' => $tank,
        ]);
    }

    /**
     * @Route("/tank/add", name="tank_add")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
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
     * @Security("has_role('ROLE_ADMIN')")
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

    /**
     * @Route("/tank/{tank}/compare", name="tank_compare_add")
     */
    public function tankAddToCompareAction(Request $request, Tank $tank)
    {
        $session = $request->getSession();

        $comparedTanks = $session->get(self::COMPARE_TANKS, []);
        if (count($comparedTanks) == self::COMPARE_LIMIT) {
            $this->addFlash('danger', 'You can compare up to three tanks only.');
        }
        elseif (array_key_exists($tank->getId(), $comparedTanks)) {
            $this->addFlash('warning', 'This tank already added to comparison.');
        }
        else {
            $comparedTanks[$tank->getId()] = $tank->getName();
            $session->set(self::COMPARE_TANKS, $comparedTanks);
            $this->addFlash('success', 'Added "'.$tank->getName().'" to comparison.');
        }

        return $this->redirectToRoute('tank_page', [
            'tank' => $tank->getId(),
        ]);
    }

    /**
     * @Route("/tank/compare", name="tank_compare")
     */
    public function tankCompareAction(Request $request)
    {
        $session = $request->getSession();
        $comparedTanks = $session->get(self::COMPARE_TANKS, []);

        ksort($comparedTanks);
        $header = implode(' vs ', array_values($comparedTanks));

        $tanks = $this->getDoctrine()->getManager()->getRepository(Tank::class)
            ->createQueryBuilder('t')
            ->where('t.id IN (:ids)')
            ->setParameter('ids', array_keys($comparedTanks))
            ->getQuery()
            ->execute();

        $tankViews = [];
        foreach ($tanks as $tank) {
            $tankViews[] = $this->renderView('tank/tank.html.twig', [
                'tank' => $tank,
            ]);
        }

        return $this->render('tank/tank_compare.html.twig', [
            'header' => 'Comparing: '.$header,
            'tank_views' => $tankViews,
        ]);
    }

    /**
     * @Route("/tank/compare/clear", name="tank_compare_clear")
     */
    public function tankClearCompareAction(Request $request)
    {
        $session = $request->getSession();
        $session->remove(self::COMPARE_TANKS);

        $this->addFlash('success', 'Comparison cleared.');

        return $this->redirectToRoute('homepage');
    }
}

