<?php

namespace AppBundle\Services;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Yaml\Yaml;

class FixturesLoaderService
{
    /**
     * @param string $filename
     *
     * @return array
     */
    public function load($filename)
    {
        $fileLocator = new FileLocator(__DIR__.'/../Resources/fixtures');
        $fixtureConfig = $fileLocator->locate($filename);
        $fixtureConfigArray = Yaml::parse(file_get_contents($fixtureConfig));

        return $fixtureConfigArray;
    }
}
