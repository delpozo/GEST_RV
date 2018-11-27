<?php

namespace AppBundle\Controller;

use AppBundle\Entity\fournisseurs;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * Fournisseur controller.
 *
 */
class fournisseursController extends Controller
{
    /**
     * Lists all fournisseur entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $fournisseurs = $em->getRepository('AppBundle:fournisseurs')->findAll();

        return $this->render('fournisseurs/index.html.twig', array(
            'fournisseurs' => $fournisseurs,
        ));
    }

    /**
     * Creates a new fournisseur entity.
     *
     */
    public function newAction(Request $request)
    {
        $fournisseur = new Fournisseur();
        $form = $this->createForm('AppBundle\Form\fournisseursType', $fournisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fournisseur);
            $em->flush();

            return $this->redirectToRoute('fournisseurs_show', array('id' => $fournisseur->getId()));
        }

        return $this->render('fournisseurs/new.html.twig', array(
            'fournisseur' => $fournisseur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a fournisseur entity.
     *
     */
    public function showAction(fournisseurs $fournisseur)
    {
        $deleteForm = $this->createDeleteForm($fournisseur);

        return $this->render('fournisseurs/show.html.twig', array(
            'fournisseur' => $fournisseur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing fournisseur entity.
     *
     */
    public function editAction(Request $request, fournisseurs $fournisseur)
    {
        $deleteForm = $this->createDeleteForm($fournisseur);
        $editForm = $this->createForm('AppBundle\Form\fournisseursType', $fournisseur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fournisseurs_edit', array('id' => $fournisseur->getId()));
        }

        return $this->render('fournisseurs/edit.html.twig', array(
            'fournisseur' => $fournisseur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a fournisseur entity.
     *
     */
    public function deleteAction(Request $request, fournisseurs $fournisseur)
    {
        $form = $this->createDeleteForm($fournisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($fournisseur);
            $em->flush();
        }

        return $this->redirectToRoute('fournisseurs_index');
    }

    /**
     * Creates a form to delete a fournisseur entity.
     *
     * @param fournisseurs $fournisseur The fournisseur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(fournisseurs $fournisseur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fournisseurs_delete', array('id' => $fournisseur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
