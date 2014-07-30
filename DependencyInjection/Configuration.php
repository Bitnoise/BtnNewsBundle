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
                ->arrayNode('control')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('news')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->arrayNode('list')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->booleanNode('show_action')->defaultTrue()->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('news_category')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->arrayNode('list')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->booleanNode('show_action')->defaultTrue()->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.
        return $treeBuilder;
    }
}
