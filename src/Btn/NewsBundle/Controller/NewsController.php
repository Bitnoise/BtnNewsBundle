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
        $news = $this->getDoctrine()->getManager()->getRepository('BtnNewsBundle:News')->findAll();

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
        if ($url = $this->get('session')->get('_btn_node')) {
            $backUrl = $this->generateUrl('_btn_node', array('url' => $url));
        }

        return array('news' => $news, 'backUrl' => $backUrl);
    }

    /**
     * @Route("/news/category/{id}", name="app_news_category")
     * @Template()
     */
    public function categoryAction(Request $request)
    {
        $categoryId = $request->get('id');
        $news   = $this->getDoctrine()
            ->getManager()
            ->getRepository('BtnNewsBundle:News')
            ->findBy(
                array('category' => $categoryId)
            )
        ;

        return $this->render("BtnNewsBundle:News:index.html.twig", array('news' => $news));
    }
}
