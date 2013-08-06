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

    public function resolveRouteName($formData = array())
    {
        //resolve from request and return the route name for node in nodes tree

        return $formData['action'];
    }


    public function resolveControlRouteName($formData = array())
    {
        //resolve from request and return the route name for node in nodes tree

        return $this->router->generate('cp_news');
    }
}