<?php

namespace Btn\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
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
        //default
        $backUrl = $this->generateUrl('news');

        //resolve back to list url
        if ($url = $this->get('session')->get('_btn_slug')) {

            $backUrl = $this->generateUrl('_btn_slug', array('url' => $url));
        }

        return array('news' => $news, 'backUrl' => $backUrl);
    }
}