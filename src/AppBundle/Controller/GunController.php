<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Gun;
use AppBundle\Entity\Tank;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class GunController extends Controller
{
    /**
     * @Route("/gun/{slug}/view", name="gun_page")
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
}

