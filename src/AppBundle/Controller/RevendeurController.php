<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Revendeur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Revendeur controller.
 *
 */
class RevendeurController extends Controller
{
    /**
     * Lists all revendeur entities.
     *
     */
    public function indexAction(Request $request)
    {
        $reprostiry=$this->getDoctrine()->getRepository("AppBundle:Revendeur");
        $query=$reprostiry->createQueryBuilder('revendeur')->select('revendeur')->orderBy('revendeur.nom','ASC')->getQuery();
                             $paginator=$this->get('knp_paginator');
                             $revendeurs=$paginator->paginate(
                               $query,
                               $request->query->getInt('page',1),
                               6
                             );
      
                              if($request->getMethod() == 'POST')
                                     {
                                         $query=$reprostiry->createQueryBuilder('revendeur')->select('revendeur')
                                                 ->where('revendeur.nom = ?1')
      
                                                 ->orderBy('revendeur.nom','ASC')->getQuery();
                             $paginator=$this->get('knp_paginator');
                             $revendeurs=$paginator->paginate(
                               $query,
                               $request->query->getInt('page',1),
                               6
                             );
                             /*$formatted = [];
                             foreach ($revendeurs as $revendeur) {
                                 $formatted[] = [
                                    'id' => $revendeur->getId(),
                                    'nom' => $revendeur->getNom(),
                                    'prenom' => $revendeur->getPrenom(),
                                 ];
                             }
                             //Validator::validate();
                             return new JsonResponse($formatted);
                                           
                                                    }*/
                                            return $this->render('revendeur/index.html.twig', array(
                                                'revendeurs' => $revendeurs,
                                                    ));}    return $this->render('revendeur/index.html.twig', [
                                                           'revendeurs' => $revendeurs,
                                                               ]);
                                                               /*
                                                               $formatted = [];
                                                               foreach ($revendeurs as $revendeur) {
                                                                   $formatted[] = [
                                                                      'id' => $revendeur->getId(),
                                                                      'nom' => $revendeur->getNom(),
                                                                      'prenom' => $revendeur->getPrenom(),
                                                                      'numtel' => $revendeur->getNumTel(),
                                                                      'mun_fix' => $revendeur->getNumFix(),
                                                                      'email' =>  $revendeur->getEmail(),
                                                                      'adress' => $revendeur->getAdress(),
                                                                      'deponse' => $revendeur->getDeponse(),
                                                                      'credit' => $revendeur->getCredit(),
                                                                      'date' => $revendeur->getDate(), 
                                                                      
                                                                   ];
                                                               }
                                                               //Validator::validate();
                                                               return new JsonResponse($formatted);*/
                     
                        }

    /**
     * Creates a new revendeur entity.
     *
     */
    public function newAction(Request $request)
    {
        $revendeur = new Revendeur();
        $form = $this->createForm('AppBundle\Form\RevendeurType', $revendeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($revendeur);
            $em->flush();

            return $this->redirectToRoute('revendeur_show', array('id' => $revendeur->getId()));
        }

        return $this->render('revendeur/new.html.twig', array(
            'revendeur' => $revendeur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a revendeur entity.
     *
     */
    public function showAction(Revendeur $revendeur)
    {
        $deleteForm = $this->createDeleteForm($revendeur);

        return $this->render('revendeur/show.html.twig', array(
            'revendeur' => $revendeur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing revendeur entity.
     *
     */
    public function editAction(Request $request, Revendeur $revendeur)
    {
        $deleteForm = $this->createDeleteForm($revendeur);
        $editForm = $this->createForm('AppBundle\Form\RevendeurType', $revendeur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('revendeur_edit', array('id' => $revendeur->getId()));
        }

        return $this->render('revendeur/edit.html.twig', array(
            'revendeur' => $revendeur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a revendeur entity.
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        if(!$id)
        {
            throw $this->createNotFoundException('No ID found');
        }

        $movie = $this->getDoctrine()->getEntityManager()->getRepository('AppBundle:Revendeur')->Find($id);

        if($movie != null)
        {
            $em->remove($movie);
            $em->flush();
        }

        return $this->redirectToRoute('revendeur_index');
    }

    /**
     * Creates a form to delete a revendeur entity.
     *
     * @param Revendeur $revendeur The revendeur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Revendeur $revendeur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('revendeur_delete', array('id' => $revendeur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
