<?php

namespace AppBundle\EventListener;

use AppBundle\Entity\UploadableInterface;
use AppBundle\Services\FileUploaderService;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUploadListener
{
    private $fileUploader;

    public function __construct(FileUploaderService $fileUploader)
    {
        $this->fileUploader = $fileUploader;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadImage($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadImage($entity);
    }

    public function uploadImage($entity)
    {
        if (!$entity instanceof UploadableInterface) {
            return;
        }

        $imageContents = $entity->getImageFile();

        if ($imageContents instanceof UploadedFile) {
            /** @var FileUploaderService $fileUploader */
            $fileUploader = $this->fileUploader;
            $entity->setImage($fileUploader->upload($imageContents));
        }
    }
}

