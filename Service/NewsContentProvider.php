<?php

namespace Btn\NewsBundle\Service;

use Btn\NodesBundle\Service\NodeContentProviderInterface;
use Btn\NewsBundle\Form\NodeContentType;

/**
*
*
*/
class NewsContentProvider implements NodeContentProviderInterface
{

    private $router;

    public function __construct($router)
    {
        $this->router = $router;
    }

    public function getForm()
    {
        return new NodeContentType();
    }

    public function resolveRoute($formData = array())
    {
        return $formData['action'];
    }

    public function resolveRouteParameters($formData = array())
    {
        return array();
    }

    public function resolveControlRoute($formData = array())
    {
        return 'cp_news';
    }

    public function resolveControlRouteParameters($formData = array())
    {
        return array();
    }
}