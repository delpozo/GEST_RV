<?php

namespace AppBundle\Controller;

use AppBundle\Entity\vende;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Vende controller.
 *
 */
class vendeController extends Controller
{
    /**
     * Lists all vende entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $vendes = $em->getRepository('AppBundle:vende')->findAll();

        return $this->render('vende/index.html.twig', array(
            'vendes' => $vendes,
        ));
    }

    /**
     * Creates a new vende entity.
     *
     */
    public function newAction(Request $request)
    {
        $vende = new Vende();
        $form = $this->createForm('AppBundle\Form\vendeType', $vende);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($vende);
            $em->flush();

            return $this->redirectToRoute('vende_show', array('id' => $vende->getId()));
        }

        return $this->render('vende/new.html.twig', array(
            'vende' => $vende,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a vende entity.
     *
     */
    public function showAction(vende $vende)
    {
        $deleteForm = $this->createDeleteForm($vende);

        return $this->render('vende/show.html.twig', array(
            'vende' => $vende,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing vende entity.
     *
     */
    public function editAction(Request $request, vende $vende)
    {
        $deleteForm = $this->createDeleteForm($vende);
        $editForm = $this->createForm('AppBundle\Form\vendeType', $vende);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vende_edit', array('id' => $vende->getId()));
        }

        return $this->render('vende/edit.html.twig', array(
            'vende' => $vende,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a vende entity.
     *
     */
    public function deleteAction(Request $request, vende $vende)
    {
        $form = $this->createDeleteForm($vende);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($vende);
            $em->flush();
        }

        return $this->redirectToRoute('vende_index');
    }

    /**
     * Creates a form to delete a vende entity.
     *
     * @param vende $vende The vende entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(vende $vende)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('vende_delete', array('id' => $vende->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
