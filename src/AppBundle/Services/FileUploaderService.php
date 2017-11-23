<?php

namespace AppBundle\Services;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploaderService
{
    private $uploadsDirectory;

    public function __construct($uploadsDirectory)
    {
        $this->uploadsDirectory = $uploadsDirectory;
    }

    public function upload(UploadedFile $file)
    {
        $fileName = $this->getFilename($file);

        $file->move(
            $this->getUploadsDirectory(),
            $fileName
        );

        return $fileName;
    }

    public function getFilename(File $file) {
        return md5(uniqid()).'.'.$file->guessExtension();
    }

    public function getUploadsDirectory()
    {
        return $this->uploadsDirectory;
    }
}

