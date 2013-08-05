<?php

namespace Btn\NewsBundle\Service;

use Symfony\Component\HttpFoundation\Request;
use Btn\NodesBundle\Service\NodeContentProviderInterface;
use Btn\NewsBundle\Form\NodeContentType;

/**
*
*
*/
class NewsContentProvider implements NodeContentProviderInterface
{
    public function getForm()
    {
        return new NodeContentType();
    }

    public function resolveRouteName(Request $request)
    {
        //resolve from request and return the route name for node in nodes tree

        return '/news';
    }
}