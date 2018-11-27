<?php

namespace AppBundle\Controller;

use AppBundle\Entity\type_produit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Type_produit controller.
 *
 */
class type_produitController extends Controller
{
    /**
     * Lists all type_produit entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $type_produits = $em->getRepository('AppBundle:type_produit')->findAll();

        return $this->render('type_produit/index.html.twig', array(
            'type_produits' => $type_produits,
        ));
    }

    /**
     * Creates a new type_produit entity.
     *
     */
    public function newAction(Request $request)
    {
        $type_produit = new Type_produit();
        $form = $this->createForm('AppBundle\Form\type_produitType', $type_produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($type_produit);
            $em->flush();

            return $this->redirectToRoute('type_produit_show', array('id' => $type_produit->getId()));
        }

        return $this->render('type_produit/new.html.twig', array(
            'type_produit' => $type_produit,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a type_produit entity.
     *
     */
    public function showAction(type_produit $type_produit)
    {
        $deleteForm = $this->createDeleteForm($type_produit);

        return $this->render('type_produit/show.html.twig', array(
            'type_produit' => $type_produit,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing type_produit entity.
     *
     */
    public function editAction(Request $request, type_produit $type_produit)
    {
        $deleteForm = $this->createDeleteForm($type_produit);
        $editForm = $this->createForm('AppBundle\Form\type_produitType', $type_produit);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_produit_edit', array('id' => $type_produit->getId()));
        }

        return $this->render('type_produit/edit.html.twig', array(
            'type_produit' => $type_produit,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a type_produit entity.
     *
     */
    public function deleteAction(Request $request, type_produit $type_produit)
    {
        $form = $this->createDeleteForm($type_produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($type_produit);
            $em->flush();
        }

        return $this->redirectToRoute('type_produit_index');
    }

    /**
     * Creates a form to delete a type_produit entity.
     *
     * @param type_produit $type_produit The type_produit entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(type_produit $type_produit)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('type_produit_delete', array('id' => $type_produit->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
