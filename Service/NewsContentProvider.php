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
    private $em;

    public function __construct($router, $em)
    {
        $this->router = $router;
        $this->em     = $em;
    }

    public function getForm()
    {
        $categories = $this->em->getRepository('BtnNewsBundle:NewsCategory')->findAll();

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
        return 'cp_news';
    }

    public function resolveControlRouteParameters($formData = array())
    {
        return array('id' => $formData['category']);
    }
}
