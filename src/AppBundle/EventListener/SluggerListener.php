<?php

namespace AppBundle\EventListener;

use AppBundle\Entity\SluggableInterface;
use AppBundle\Services\SluggerService;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class SluggerListener
{
    private $sluggerService;

    public function __construct(SluggerService $sluggerService)
    {
        $this->sluggerService = $sluggerService;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $this->slugify($args->getEntity());
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $this->slugify($args->getEntity());
    }

    public function slugify($entity)
    {
        if ($entity instanceof SluggableInterface) {
            $slug = $this->sluggerService->slugify($entity->getName());
            $entity->setSlug($slug);
        }
    }
}
