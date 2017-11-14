<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Gun;
use AppBundle\Entity\Tank;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        /** @var Registry $entityManager */
        $entityManager = $this->get('doctrine');
        /** @var Tank[] $tanks */
        $tanks = $entityManager->getRepository(Tank::class)->findAll();
        /** @var Gun[] $guns */
        $guns = $entityManager->getRepository(Gun::class)->findAll();

        return $this->render('main/index.html.twig', [
            'tanks' => $tanks,
            'guns' => $guns,
        ]);
    }
}
