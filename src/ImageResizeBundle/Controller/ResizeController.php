<?php

namespace ImageResizeBundle\Controller;

use ImageResizeBundle\Services\ImageResizeService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ResizeController extends Controller
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
        /** @var ImageResizeService $resizeService */
        $resizeService = $this->get('image_resizer');

        $targetImageDimensions = $resizeService->getSizeFromParam($size);
        $resizedImagePath = $resizeService->getResizedImage($filename, $targetImageDimensions);

        $response = new Response();
        try {
            $file = new File($resizedImagePath);
            $response->headers->set('Content-Type', $file->getMimeType());
            $response->headers->set('Cache-Control', 'max-age=86400, public');
            $response->headers->set('Expires', gmdate(DATE_RFC1123, time() + 86400));
            $response->setStatusCode(Response::HTTP_OK);
            $response->setContent(file_get_contents($file->getRealPath()));
        } catch (FileNotFoundException $e) {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
            $response->setContent('File not found.');
        }

        return $response;
    }
}
