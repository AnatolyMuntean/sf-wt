<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Gun;
use AppBundle\Entity\Tank;
use Doctrine\Bundle\DoctrineBundle\Registry;
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
}

