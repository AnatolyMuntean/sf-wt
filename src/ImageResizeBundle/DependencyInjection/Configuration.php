<?php

namespace ImageResizeBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $root = $treeBuilder->root('image_resize');

        $root
            ->children()
                ->scalarNode('image_storage')->end()
                ->integerNode('jpeg_quality')->end()
                ->integerNode('png_compression_level')->end()
                ->integerNode('aspect_precision')->end()
            ->end();

        return $treeBuilder;
    }
}
