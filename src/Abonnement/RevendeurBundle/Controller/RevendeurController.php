<?php

namespace Abonnement\RevendeurBundle\Controller;

use Abonnement\RevendeurBundle\Entity\Revendeur;
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
        $reprostiry=$this->getDoctrine()->getRepository("AbonnementRevendeurBundle:Revendeur");
        $query=$reprostiry->createQueryBuilder('revendeur')->select('revendeur')->orderBy('revendeur.prixAchat','ASC')->getQuery();
                             $paginator=$this->get('knp_paginator');
                             $revendeurs=$paginator->paginate(
                               $query,
                               $request->query->getInt('page',1),
                               6
                             );
      
                              if($request->getMethod() == 'POST')
                                     {
                                         $query=$reprostiry->createQueryBuilder('revendeur')->select('revendeur')
                                                 ->where('revendeur.prixAchat = ?1')
      
                                                 ->orderBy('revendeur.prixAchat','ASC')->getQuery();
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
     * recherche type
     */
    public function recherchtypeAction (Request $request)
    {
        $type = $request->query->get('type');
        //var_dump($type);
        $em_type = $this->getDoctrine()->getRepository("AppBundle:type_produit");
        $query = $em_type->createQueryBuilder('T')
            ->select('T.id as a')
            ->where(' T.type LIKE :type')
            ->setParameter('type', '%'.$type.'%')
            ->getQuery();
        $type_id = $query->getResult();
        //var_dump($type_id['0']["a"]);

        $em_type = $this->getDoctrine()->getRepository("AppBundle:produits");
        $query = $em_type->createQueryBuilder('P')
            ->select('P.id as a', 'P.prixRevend','P.abonnement')
            ->innerJoin('AppBundle:vende', 'V')
            ->where(' P.type_produit = :ala and P.id != V.produits and P.vendu = 0' )
            ->setMaxResults(1)  
            ->setParameter('ala',intval($type_id['0']["a"]))
            ->getQuery();
        $etat = $query->getResult();

        return $this->render('revendeur/recherche.html.twig', [
            'type_id' => $etat,
            ]);
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    /**
     * recherche type
     */
    public function achatAction (Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        //recuperation du current user
        $currentuser = $this->getUser();
        $id_user = $currentuser->getId();
        var_dump($id_user);
        $user = $em->getRepository('AppBundle:User')->findOneById($id_user);

        $type = $request->query->get('type');
        //var_dump($type);
        $em_type = $this->getDoctrine()->getRepository("AppBundle:type_produit");
        $query = $em_type->createQueryBuilder('T')
            ->select('T.id as id_type')
            ->where(' T.type LIKE :type')
            ->setParameter('type', '%'.$type.'%')
            ->getQuery();
        $type_id = $query->getResult();
        //var_dump($type_id['0']["a"]);

        $em_type = $this->getDoctrine()->getRepository("AppBundle:produits");
        $query = $em_type->createQueryBuilder('P')
            ->select('P.id as id_produit', 'P.nom','P.prixRevend','P.abonnement')
            ->innerJoin('AppBundle:vende', 'V')
            ->where(' P.type_produit = :id_type and P.id != V.produits and P.vendu = 0' )
            ->setMaxResults(1)  
            ->setParameter('id_type',intval($type_id['0']["id_type"]))
            ->getQuery();
        $etat = $query->getResult();

        $produit = $em->getRepository('AppBundle:produits')->findOneById(intval($etat['0']["id_produit"]));
        $adddate = '+'.$etat['0']['abonnement'] . ' month' ;

        $revendeur = new Revendeur();
          
        $revendeur->setProduits($produit)->setprixAchat($etat['0']['prixRevend'])->setCode(self::generateRandomString(6))->setDate(new \DateTime())->setDateAc(new \DateTime())->setUser($user)->setDateEx(new \DateTime($adddate))->setCredit("null")->setDeponse("null")->setAbonner($etat['0']["abonnement"]);
        $em = $this->getDoctrine()->getManager();
        $em->persist($revendeur);
        $em->flush();

        $em_prod = $this->getDoctrine()->getRepository("AppBundle:produits");
            $query = $em_prod->createQueryBuilder('P')
            ->update('AppBundle:produits' , 'P')
            ->set('P.vendu ' , '1')
            ->where('P.id = :id_prod')
            ->setParameter('id_prod', intval($etat['0']["id_produit"]))
            ->getQuery();
        $produits = $query->execute();

        return $this->redirectToRoute('revendeur_show', array(
            'id' => $revendeur->getId(),
                ));
    }

    public function rhomeAction(Request $request)
    {
        return $this->render('revendeur\rhome.html.twig');
    }

    public function recherchAction()
    {
        $em = $this->getDoctrine()->getManager();

        $types = $em->getRepository('AppBundle:type_produit')->findAll();

        
        return $this->render('revendeur\new.html.twig', array(
            'type_produit' => $types,
        ));
    }

    /**
     * Creates a new revendeur entity.
     *
     */
    public function newAction(Request $request)
    {


        $revendeur = new Revendeur();
        $form = $this->createForm('Abonnement\RevendeurBundle\Form\RevendeurType', $revendeur);
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
        $editForm = $this->createForm('Abonnement\RevendeurBundle\Form\RevendeurType', $revendeur);
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
