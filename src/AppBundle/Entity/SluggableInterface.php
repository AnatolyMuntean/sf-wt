<?php

namespace AppBundle\Entity;

interface SluggableInterface
{
    public function setSlug($slug);
    public function getSlug();
}
