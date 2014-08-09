<?php

namespace Btn\NewsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Btn\NewsBundle\Entity\News;
use Btn\NewsBundle\Form\NewsType;

/**
 * News controller.
 *
 * @Route("/news")
 */
class NewsControlController extends Controller
{
    /**
     * Lists all News entities.
     *
     * @Route("/", name="cp_news")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BtnNewsBundle:News')->findAll();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $entities,
            $this->get('request')->query->get('page', 1),
            10
        );

        $pagination->setTemplate('BtnCrudBundle:Pagination:default.html.twig');

        $config = $this->container->getParameter('btn_news');

        return array(
            'pagination'  => $pagination,
            'list_config' => $config['control']['news']['list'],
        );
    }

    /**
     * Finds and displays a News entity.
     *
     * @Route("/{id}/show", name="cp_news_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BtnNewsBundle:News')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find News entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new News entity.
     *
     * @Route("/new", name="cp_news_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new News();
        $form   = $this->createForm(new NewsType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new News entity.
     *
     * @Route("/create", name="cp_news_create")
     * @Method("POST")
     * @Template("BtnNewsBundle:NewsControl:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new News();
        $form = $this->createForm(new NewsType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $msg = $this->get('translator')->trans('crud.flash.saved');
            $this->get('session')->getFlashBag()->add('success', $msg);

            return $this->redirect($this->generateUrl('cp_news_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing News entity.
     *
     * @Route("/{id}/edit", name="cp_news_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BtnNewsBundle:News')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find News entity.');
        }

        $editForm = $this->createForm(new NewsType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing News entity.
     *
     * @Route("/{id}/update", name="cp_news_update")
     * @Method("POST")
     * @Template("BtnNewsBundle:NewsControl:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BtnNewsBundle:News')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find News entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new NewsType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            $msg = $this->get('translator')->trans('crud.flash.saved');
            $this->get('session')->getFlashBag()->add('success', $msg);

            return $this->redirect($this->generateUrl('cp_news_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a News entity.
     *
     * @Route("/{id}/delete", name="cp_news_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BtnNewsBundle:News')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find News entity.');
            }

            $em->remove($entity);
            $em->flush();

            $msg = $this->get('translator')->trans('crud.flash.deleted');
            $this->get('session')->getFlashBag()->add('success', $msg);
        }

        return $this->redirect($this->generateUrl('cp_news'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
