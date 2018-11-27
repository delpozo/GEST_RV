<?php

namespace AppBundle\Controller;

use AppBundle\Entity\devise;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Devise controller.
 *
 */
class deviseController extends Controller
{
    /**
     * Lists all devise entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $devises = $em->getRepository('AppBundle:devise')->findAll();

        return $this->render('devise/index.html.twig', array(
            'devises' => $devises,
        ));
    }

    /**
     * Creates a new devise entity.
     *
     */
    public function newAction(Request $request)
    {
        $devise = new Devise();
        $form = $this->createForm('AppBundle\Form\deviseType', $devise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($devise);
            $em->flush();

            return $this->redirectToRoute('devise_show', array('id' => $devise->getId()));
        }

        return $this->render('devise/new.html.twig', array(
            'devise' => $devise,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a devise entity.
     *
     */
    public function showAction(devise $devise)
    {

        $deleteForm = $this->createDeleteForm($devise);

        return $this->render('devise/show.html.twig', array(
            'devise' => $devise,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing devise entity.
     *
     */
    public function editAction(Request $request, devise $devise)
    {
        $deleteForm = $this->createDeleteForm($devise);
        $editForm = $this->createForm('AppBundle\Form\deviseType', $devise);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('devise_edit', array('id' => $devise->getId()));
        }

        return $this->render('devise/edit.html.twig', array(
            'devise' => $devise,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a devise entity.
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        if(!$id)
        {
            throw $this->createNotFoundException('No ID found');
        }

        $movie = $this->getDoctrine()->getEntityManager()->getRepository('AppBundle:devise')->Find($id);

        if($movie != null)
        {
            $em->remove($movie);
            $em->flush();
        }

        return $this->redirectToRoute('devise_index');
    }
    /**
     * Creates a form to delete a devise entity.
     *
     * @param devise $devise The devise entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(devise $devise)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('devise_delete', array('id' => $devise->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
