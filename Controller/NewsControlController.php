<?php

namespace Btn\NewsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Btn\BaseBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/news")
 */
class NewsControlController extends AbstractController
{
    /**
     * @Route("/", name="btn_news_newscontrol_index")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $perPage  = $this->container->getParameter('btn_admin.per_page');
        $repo     = $this->get('btn_news.provider.news')->getRepository();
        $entities = $repo->findAll();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $entities,
            $request->query->getInt('page', 1),
            $perPage
        );

        return array(
            'pagination'  => $pagination,
        );
    }

    /**
     * @Route("/new", name="cp_news_new", methods={"GET"})
     * @Route("/create", name="cp_news_create", methods={"POST"})
     * @Template()
     */
    public function createAction(Request $request)
    {
        $entityProvider = $this->get('btn_news.provider.news');
        $formHandler    = $this->get('btn_admin.form_handler');
        $entity         = $entityProvider->create();

        $form = $this->createForm('btn_news_form_news_control', $entity, array(
            'action' => $this->generateUrl('cp_news_create'),
        ));


        if ($formHandler->handle($form)) {
            $this->setFlash('btn_admin.flash.created');

            return $this->redirect($this->generateUrl('cp_news_edit', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * @Route("/{id}/edit", name="cp_news_edit", methods={"GET"})
     * @Route("/{id}/update", name="cp_news_update", methods={"POST"}))
     * @Template()
     */
    public function updateAction(Request $request, $id)
    {
        $entityProvider = $this->get('btn_news.provider.news');
        $formHandler    = $this->get('btn_admin.form_handler');
        $entity         = $this->findEntityOr404($entityProvider->getClass(), $id);

        $form = $this->createForm('btn_news_form_news_control', $entity, array(
            'action' => $this->generateUrl('cp_news_update', array('id' => $id)),
        ));

        if ($formHandler->handle($form)) {
            $this->setFlash('btn_admin.flash.updated');

            return $this->redirect($this->generateUrl('cp_news_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * @Route("/{id}/delete/{csrf_token}", name="cp_news_delete")
     */
    public function deleteAction(Request $request, $id, $csrf_token)
    {
        $this->validateCsrfTokenOrThrowException('cp_news_delete', $csrf_token);

        $entityProvider = $this->get('btn_news.provider.news');
        $entity         = $this->findEntityOr404($id, $entityProvider->getClass());

        $entityProvider->delete($entity);

        $this->setFlash('btn_admin.flash.deleted');

        return $this->redirect($this->generateUrl('btn_news_newscontrol_index'));
    }
}
