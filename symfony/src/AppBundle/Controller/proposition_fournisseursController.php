<?php

namespace AppBundle\Controller;

use AppBundle\Entity\proposition_fournisseurs;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Proposition_fournisseur controller.
 *
 */
class proposition_fournisseursController extends Controller
{
    /**
     * Lists all proposition_fournisseur entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $proposition_fournisseurs = $em->getRepository('AppBundle:proposition_fournisseurs')->findAll();

        return $this->render('proposition_fournisseurs/index.html.twig', array(
            'proposition_fournisseurs' => $proposition_fournisseurs,
        ));
    }

    /**
     * Creates a new proposition_fournisseur entity.
     *
     */
    public function newAction(Request $request)
    {
        $proposition_fournisseur = new Proposition_fournisseur();
        $form = $this->createForm('AppBundle\Form\proposition_fournisseursType', $proposition_fournisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($proposition_fournisseur);
            $em->flush();

            return $this->redirectToRoute('proposition_fournisseurs_show', array('id' => $proposition_fournisseur->getId()));
        }

        return $this->render('proposition_fournisseurs/new.html.twig', array(
            'proposition_fournisseur' => $proposition_fournisseur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a proposition_fournisseur entity.
     *
     */
    public function showAction(proposition_fournisseurs $proposition_fournisseur)
    {
        $deleteForm = $this->createDeleteForm($proposition_fournisseur);

        return $this->render('proposition_fournisseurs/show.html.twig', array(
            'proposition_fournisseur' => $proposition_fournisseur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing proposition_fournisseur entity.
     *
     */
    public function editAction(Request $request, proposition_fournisseurs $proposition_fournisseur)
    {
        $deleteForm = $this->createDeleteForm($proposition_fournisseur);
        $editForm = $this->createForm('AppBundle\Form\proposition_fournisseursType', $proposition_fournisseur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('proposition_fournisseurs_edit', array('id' => $proposition_fournisseur->getId()));
        }

        return $this->render('proposition_fournisseurs/edit.html.twig', array(
            'proposition_fournisseur' => $proposition_fournisseur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a proposition_fournisseur entity.
     *
     */
    public function deleteAction(Request $request, proposition_fournisseurs $proposition_fournisseur)
    {
        $form = $this->createDeleteForm($proposition_fournisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($proposition_fournisseur);
            $em->flush();
        }

        return $this->redirectToRoute('proposition_fournisseurs_index');
    }

    /**
     * Creates a form to delete a proposition_fournisseur entity.
     *
     * @param proposition_fournisseurs $proposition_fournisseur The proposition_fournisseur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(proposition_fournisseurs $proposition_fournisseur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('proposition_fournisseurs_delete', array('id' => $proposition_fournisseur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
