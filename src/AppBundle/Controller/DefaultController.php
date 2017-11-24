<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tank;
use AppBundle\Entity\VehicleType;
use AppBundle\Entity\Vendor;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

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
        /** @var Vendor[] $vendors */
        $vendors = $entityManager->getRepository(Vendor::class)->findAll();
        /** @var VehicleType[] $vehicleTypes */
        $vehicleTypes = $entityManager->getRepository(VehicleType::class)->findAll();

        return $this->render('main/index.html.twig', [
            'header' => 'List of WWII tanks and guns',
            'tanks' => $tanks,
            'vendors' => $vendors,
            'vehicle_types' => $vehicleTypes,
        ]);
    }
}
