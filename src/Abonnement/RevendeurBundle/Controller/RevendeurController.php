<?php

namespace Abonnement\RevendeurBundle\Controller;

use Abonnement\RevendeurBundle\Entity\Revendeur;
use Abonnement\RevendeurBundle\Entity\produit_rev;
use AppBundle\Entity\vende;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;


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
        $date = date('Y ', time());
        $currentuser = $this->getUser();
        $id_user = $currentuser->getId();
    
         $reprostiry=$this->getDoctrine()->getRepository("AppBundle:vende");
         $query=$reprostiry->createQueryBuilder('vende')
         ->select('vende')
         ->where('SUBSTRING (vende.date,1,4) LIKE SUBSTRING(:date,1,4) and vende.User = :user')
             ->setParameter('date', $date)
             ->setParameter('user', $id_user)
             ->orderBy('vende.prixVend','DESC')->getQuery();
         $paginator=$this->get('knp_paginator');
         $vendes=$paginator->paginate(
             $query,
             $request->query->getInt('page',1),
             6
         );   
            
            return $this->render('revendeur/index.html.twig', [
        'vendes' => $vendes,

    ]);    
    }

    /**
     * recherche produit par type
     */
    public function recherchtypeAction (Request $request)
    {
        $type = $request->query->get('type');

        $em_type = $this->getDoctrine()->getRepository("AppBundle:produits");
        $query = $em_type->createQueryBuilder('P')
            ->select('P')
            ->innerJoin('AppBundle:vende', 'V')
            ->where(' P.type_produit = :ala and P.id != V.produits and P.vendu = 0' )
            ->setMaxResults(1)  
            ->setParameter('ala',$type)
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

    public function newvente_revAction(Request $request)
        {   
            $id_prod = $request->query->get('prod');
            $vende = new Vende();
      //  $form = $this->createForm('AppBundle\Form\vendeType', $vende);
       // $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        
        //recuperation du current user
        $currentuser = $this->getUser();
        $id_user = $currentuser->getId();
        $user = $em->getRepository('AppBundle:User')->findOneById($id_user);
        $produit = $em->getRepository('AppBundle:produits')->findOneById($id_prod);

       
            //add user il form
            $vende ->setProduits($produit);
            if ($vende ->getdeponse())
            {
               $restpay = floatval($vende ->getPrixVend()) - floatval( $vende ->getdeponse());
            }
            else {
                    $restpay = null;
            }
            
            $adddate = '+'.$produit -> getAbonnement() . ' month' ;
            $vende->setEmail('--')->setNompreCli('--')->setNumTel('--')->setNumFix('--')->setAdress('--')->setAbonner($produit->getAbonnement())->setPrixVend($produit->getPrixRevend()) ->setUser($user)->setRestPay($restpay)->setDate(new \DateTime())->setDateAc(new \DateTime())->setDateEx(new \DateTime($adddate));
            $em = $this->getDoctrine()->getManager();
            $em->persist($vende);
            $em->flush();

            $em_prod = $this->getDoctrine()->getRepository("AppBundle:produits");
            $query = $em_prod->createQueryBuilder('P')
            ->update('AppBundle:produits' , 'P')
            ->set('P.vendu ' , '1')
            ->where('P.id = :id_prod')
            ->setParameter('id_prod', $id_prod)
            ->getQuery();
        $produits = $query->execute();
            return $this->redirectToRoute('revendeur_index', array(
                'user' =>  $id_user,
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
        $currentuser = $this->getUser();
        $id_user = $currentuser->getId();
        
        return $this->render('revendeur\new.html.twig', array(
            'user' =>  $id_user,
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
