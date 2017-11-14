<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Gun;
use AppBundle\Entity\Tank;
use Doctrine\Bundle\DoctrineBundle\Registry;
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
}

