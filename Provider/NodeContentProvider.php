<?php

namespace Btn\NewsBundle\Provider;

use Btn\NodesBundle\Service\NodeContentProviderInterface;
use Btn\NewsBundle\Form\NodeContentType;
use Btn\AdminBundle\Provider\EntityProviderInterface;

/**
 *
 */
class NodeContentProvider implements NodeContentProviderInterface
{
    protected $provider;

    public function __construct(EntityProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    public function getForm()
    {
        $categories = $this->provider->getRepository()->findAll();

        $data = array();
        foreach ($categories as $category) {
            $data[$category->getId()] = $category->getTitle();
        }

        return new NodeContentType($data);
    }

    public function resolveRoute($formData = array())
    {
        return 'app_news_category';
    }

    public function resolveRouteParameters($formData = array())
    {
        return array('id' => $formData['category']);
    }

    public function resolveControlRoute($formData = array())
    {
        return 'btn_news_newscontrol_index';
    }

    public function resolveControlRouteParameters($formData = array())
    {
        return array('id' => $formData['category']);
    }
}