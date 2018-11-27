<?php

namespace AppBundle\Controller;

use AppBundle\Entity\fournisseurs;
use Doctrine\ORM\Mapping\Id;
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
    public function indexAction(Request $request)
   {
 $reprostiry=$this->getDoctrine()->getRepository("AppBundle:fournisseurs");
  $query=$reprostiry->createQueryBuilder('fournisseur')->select('fournisseur')->orderBy('fournisseur.nom','ASC')->getQuery();
                       $paginator=$this->get('knp_paginator');
                       $fournisseurs=$paginator->paginate(
                         $query,
                         $request->query->getInt('page',1),
                         6
                       );

                        if($request->getMethod() == 'POST')
                               {
                                   $query=$reprostiry->createQueryBuilder('fournisseur')->select('fournisseur')
                                           ->where('fournisseur.nom = ?1')

                                           ->orderBy('fournisseur.nom','ASC')->getQuery();
                       $paginator=$this->get('knp_paginator');
                       $fournisseurs=$paginator->paginate(
                         $query,
                         $request->query->getInt('page',1),
                         6
                       );
                      
                       return $this->render('fournisseurs/index.html.twig', array(
                           'fournisseurs' => $fournisseurs,
                               ));}    return $this->render('fournisseurs/index.html.twig', [
                                      'fournisseurs' => $fournisseurs,
                                          ]);

   }

    public function addAction($id_four)
    {

        $response = $this->forward('AppBundle:statfour:add', array(
            'id_four' => $id_four,
        ));

        return $response;
    }
     public function TESTAction($id_four)
    {

        $response = $this->forward('AppBundle:statfour:add', array(
            'id_four' => $id_four,
        ));

        return $response;
    }
    public function updateAction($id_four)
    {

        $response = $this->forward('AppBundle:statfour:update', array(
            'id_four' => $id_four,
        ));

        return $response;
    }


    /**
     * Creates a new fournisseur entity.
     *
     */
    public function newAction(Request $request)
    {
        $fournisseur = new Fournisseurs();
        $form = $this->createForm('AppBundle\Form\fournisseursType', $fournisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fournisseur ->setDate(new \DateTime());
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

    public function showAction(fournisseurs $fournisseurs)
    {
        $em = $this->getDoctrine()->getRepository("AppBundle:statfour");
        // liste vendes de cette fournisseur

        $query = $em->createQueryBuilder('S')
            ->select('S.idElem as idelem', 'S.nbProduitNVend as nb_produit_N_vend', 'S.nbProduitVend as nb_produit_vend', 'S.listProduitVend as list_produit_vend', 'S.listVend as list_vend', 'S.deponse', 'S.credit')
            ->where('S.idElem = :id_four')
            ->setParameter('id_four', $fournisseurs->getId())
            ->getQuery();
        $statfour = $query->getResult();
        if ($statfour != null) {
            $deleteForm = $this->createDeleteForm($fournisseurs);

            return $this->render('fournisseurs/show.html.twig', array(
                'idelem' => $statfour['0']['idelem'],
                'nb_produit_N_vend' => $statfour['0']['nb_produit_N_vend'],
                'nb_produit_vend' => $statfour['0']['nb_produit_vend'],
                'list_produit_vend' => $statfour['0']['list_produit_vend'],
                'list_vend' => $statfour['0']['list_vend'],
                'deponse' => $statfour['0']['deponse'],
                'credit' => $statfour['0']['credit'],
                'fournisseur' => $fournisseurs,
                'delete_form' => $deleteForm->createView(),
            ));
        } else {

            return $this->render('fournisseurs/show.html.twig', array(
                'idelem'       => null,
                'fournisseur' => $fournisseurs,
            ));
        }
    }


    /**
     * Displays a form to edit an existing fournisseur entity.
     *
     */
    public function editAction(Request $request, fournisseurs $fournisseur)
    {
        $deleteForm= $this->createDeleteForm($fournisseur);
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

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        if(!$id)
        {
            throw $this->createNotFoundException('No ID found');
        }

        $movie = $this->getDoctrine()->getEntityManager()->getRepository('AppBundle:fournisseurs')->Find($id);

        if($movie != null)
        {
            $em->remove($movie);
            $em->flush();
        }

        return $this->redirectToRoute('fournisseurs_index');
    }

    /**
     * Deletes a fournisseur entity.
     *
     *//*

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
