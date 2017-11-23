<?php

namespace ImageResizeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ImageResizeController extends Controller
{
    /**
     * @Route("/image/{size}/{filename}",
     *     name="image_resize",
     *     defaults={"size"="original"},
     *     requirements={"size"="original|\d{1,4}x\d{1,4}"}
     * )
     * @Method("GET")
     */
    public function imageResizeAction(Request $request, $size, $filename)
    {
        return new Response('');
    }
}
