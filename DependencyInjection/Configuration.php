<?php

namespace Btn\NewsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('btn_news');

        $rootNode
            ->children()
                ->scalarNode('news_class')->cannotBeEmpty()->defaultValue('Btn\\NewsBundle\\Entity\\News')->end()
                ->scalarNode('news_category_class')->cannotBeEmpty()->defaultValue('Btn\\NewsBundle\\Entity\\NewsCategory')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
