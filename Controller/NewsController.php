<?php

namespace Btn\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Btn\NewsBundle\Entity\News;

/**
 * News controller
 */
class NewsController extends Controller
{
    /**
     * List of all news
     *
     * @Route("/news", name="news")
     * @Template()
     */
    public function indexAction()
    {
        //@TODO: change this into pagination

        //list
        $news = $this->getDoctrine()
            ->getEntityManager()
            ->getRepository('BtnNewsBundle:News')
            ->findAll()
        ;

        return array('news' => $news);
    }

    /**
     * Finds and displays a one news
     *
     * @Route("/news/{slug}", name="news_show")
     * @Template()
     */
    public function showAction(News $news)
    {
        return array('news' => $news);
    }
}