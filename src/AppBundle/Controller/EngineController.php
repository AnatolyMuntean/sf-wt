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
}
