<?php

namespace Btn\NewsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Btn\AdminBundle\Controller\AbstractControlController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Btn\AdminBundle\Annotation\EntityProvider;

/**
 * @Route("/newscategory")
 * @EntityProvider("btn_news.provider.news_category")
 */
class NewsCategoryControlController extends AbstractControlController
{
    /**
     * @Route("/", name="btn_news_newscategorycontrol_index")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $repo     = $this->getEntityProvider()->getRepository();
        $entities = $repo->findAll();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $entities,
            $request->query->getInt('page', 1),
            $this->getPerPage()
        );

        return array(
            'pagination'  => $pagination,
        );
    }

    /**
     * @Route("/new", name="btn_news_newscategorycontrol_new", methods={"GET"})
     * @Route("/create", name="btn_news_newscategorycontrol_create", methods={"POST"})
     * @Template()
     */
    public function createAction(Request $request)
    {
        $entity = $this->getEntityProvider()->create();

        $form = $this->createForm('btn_news_form_newscategorycontrol', $entity, array(
            'action' => $this->generateUrl('btn_news_newscategorycontrol_create'),
        ));

        if ($this->handleForm($form, $request)) {
            $this->setFlash('btn_admin.flash.created');

            return $this->redirect($this->generateUrl('btn_news_newscategorycontrol_edit', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * @Route("/{id}/edit", name="btn_news_newscategorycontrol_edit", methods={"GET"})
     * @Route("/{id}/update", name="btn_news_newscategorycontrol_update", methods={"POST"}))
     * @Template()
     */
    public function updateAction(Request $request, $id)
    {
        $entity = $this->findEntityOr404($this->getEntityProvider()->getClass(), $id);

        $form = $this->createForm('btn_news_form_newscategorycontrol', $entity, array(
            'action' => $this->generateUrl('btn_news_newscategorycontrol_update', array('id' => $id)),
        ));

        if ($this->handleForm($form, $request)) {
            $this->setFlash('btn_admin.flash.updated');

            return $this->redirect($this->generateUrl('btn_news_newscategorycontrol_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * @Route("/{id}/delete/{csrf_token}", name="btn_news_newscategorycontrol_delete")
     */
    public function deleteAction(Request $request, $id, $csrf_token)
    {
        $this->validateCsrfTokenOrThrowException('btn_news_newscategorycontrol_delete', $csrf_token);

        $entityProvider = $this->getEntityProvider();
        $entity         = $this->findEntityOr404($id, $entityProvider->getClass());

        $entityProvider->delete($entity);

        $this->setFlash('btn_admin.flash.deleted');

        return $this->redirect($this->generateUrl('btn_news_newscategorycontrol_index'));
    }
}
