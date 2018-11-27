<?php

namespace AppBundle\Controller;

use AppBundle\Entity\produits_revendeurs;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Produits_revendeur controller.
 *
 */
class produits_revendeursController extends Controller
{
    /**
     * Lists all produits_revendeur entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produits_revendeurs = $em->getRepository('AppBundle:produits_revendeurs')->findAll();

        return $this->render('produits_revendeurs/index.html.twig', array(
            'produits_revendeurs' => $produits_revendeurs,
        ));
    }

    /**
     * Creates a new produits_revendeur entity.
     *
     */
    public function newAction(Request $request)
    {
        $produits_revendeur = new Produits_revendeur();
        $form = $this->createForm('AppBundle\Form\produits_revendeursType', $produits_revendeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produits_revendeur);
            $em->flush();

            return $this->redirectToRoute('produits_revendeurs_show', array('id' => $produits_revendeur->getId()));
        }

        return $this->render('produits_revendeurs/new.html.twig', array(
            'produits_revendeur' => $produits_revendeur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a produits_revendeur entity.
     *
     */
    public function showAction(produits_revendeurs $produits_revendeur)
    {
        $deleteForm = $this->createDeleteForm($produits_revendeur);

        return $this->render('produits_revendeurs/show.html.twig', array(
            'produits_revendeur' => $produits_revendeur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing produits_revendeur entity.
     *
     */
    public function editAction(Request $request, produits_revendeurs $produits_revendeur)
    {
        $deleteForm = $this->createDeleteForm($produits_revendeur);
        $editForm = $this->createForm('AppBundle\Form\produits_revendeursType', $produits_revendeur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('produits_revendeurs_edit', array('id' => $produits_revendeur->getId()));
        }

        return $this->render('produits_revendeurs/edit.html.twig', array(
            'produits_revendeur' => $produits_revendeur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a produits_revendeur entity.
     *
     */
    public function deleteAction(Request $request, produits_revendeurs $produits_revendeur)
    {
        $form = $this->createDeleteForm($produits_revendeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($produits_revendeur);
            $em->flush();
        }

        return $this->redirectToRoute('produits_revendeurs_index');
    }

    /**
     * Creates a form to delete a produits_revendeur entity.
     *
     * @param produits_revendeurs $produits_revendeur The produits_revendeur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(produits_revendeurs $produits_revendeur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('produits_revendeurs_delete', array('id' => $produits_revendeur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
