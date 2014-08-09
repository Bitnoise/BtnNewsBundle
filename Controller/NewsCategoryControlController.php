<?php

namespace Btn\NewsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Btn\NewsBundle\Entity\NewsCategory;
use Btn\NewsBundle\Form\NewsCategoryType;

/**
 * NewsCategory controller.
 *
 * @Route("/newscategory")
 */
class NewsCategoryControlController extends Controller
{
    /**
     * Lists all NewsCategory entities.
     *
     * @Route("/", name="cp_newscategory")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $newsClass = $this->cotainer->getParameter('btn_news.news_class');
        $repo = $this->getDoctrine()->getRepository($newsClass);
ldd($repo);
        return array(
            'pagination' => $manager->getPagination(),
        );
    }

    /**
     * Finds and displays a NewsCategory entity.
     *
     * @Route("/{id}/show", name="cp_newscategory_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BtnNewsBundle:NewsCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NewsCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new NewsCategory entity.
     *
     * @Route("/new", name="cp_newscategory_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new NewsCategory();
        $form   = $this->createForm(new NewsCategoryType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new NewsCategory entity.
     *
     * @Route("/create", name="cp_newscategory_create")
     * @Method("POST")
     * @Template("BtnNewsBundle:NewsCategoryControl:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new NewsCategory();
        $form = $this->createForm(new NewsCategoryType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $msg = $this->get('translator')->trans('crud.flash.saved');
            $this->getRequest()->getSession()->getFlashBag()->set('success', $msg);

            return $this->redirect($this->generateUrl('cp_newscategory_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing NewsCategory entity.
     *
     * @Route("/{id}/edit", name="cp_newscategory_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BtnNewsBundle:NewsCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NewsCategory entity.');
        }

        $editForm = $this->createForm(new NewsCategoryType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing NewsCategory entity.
     *
     * @Route("/{id}/update", name="cp_newscategory_update")
     * @Method("POST")
     * @Template("BtnNewsBundle:NewsCategoryControl:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BtnNewsBundle:NewsCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NewsCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new NewsCategoryType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            $msg = $this->get('translator')->trans('crud.flash.saved');
            $this->getRequest()->getSession()->getFlashBag()->set('success', $msg);

            return $this->redirect($this->generateUrl('cp_newscategory_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a NewsCategory entity.
     *
     * @Route("/{id}/delete", name="cp_newscategory_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BtnNewsBundle:NewsCategory')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find NewsCategory entity.');
            }

            $em->remove($entity);
            $em->flush();

            $msg = $this->get('translator')->trans('crud.flash.deleted');
            $this->getRequest()->getSession()->getFlashBag()->set('success', $msg);
        }

        return $this->redirect($this->generateUrl('cp_newscategory'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
