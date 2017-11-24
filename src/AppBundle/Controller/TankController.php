<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tank;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class TankController extends Controller
{
    const COMPARE_TANKS = 'compare-tanks';
    const COMPARE_LIMIT = 3;

    /**
     * @Route("/tank/{slug}/view", name="tank_page")
     */
    public function tankViewAction(Request $request, Tank $tank)
    {
        return $this->render('tank/tank_view.html.twig', [
            'header' => $tank->getName(),
            'tank' => $tank,
        ]);
    }

    /**
     * @Route("/tank/{slug}/compare", name="tank_compare_add")
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
            'slug' => $tank->getSlug(),
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

