<?php

namespace Btn\NewsBundle\DependencyInjection;

use Btn\BaseBundle\DependencyInjection\AbstractExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 *
 */
class BtnNewsExtension extends AbstractExtension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        parent::load($configs, $container);

        $config = $this->getProcessedConfig($container, $configs);

        $container->setParameter('btn_news.news.class', $config['news']['class']);
        $container->setParameter('btn_news.news_category.class', $config['news_category']['class']);
    }
}
