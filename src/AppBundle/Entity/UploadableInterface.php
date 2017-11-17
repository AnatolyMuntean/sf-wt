<?php

namespace AppBundle\Entity;

interface UploadableInterface
{
    public function getImage();
    public function setImage($image);
    public function getImageFile();
    public function setImageFile($image);
}
