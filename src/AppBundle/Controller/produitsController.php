<?php

namespace AppBundle\Controller;

use AppBundle\Entity\produits;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Produit controller.
 *
 */
class produitsController extends Controller
{
    /**
     * Lists all produit entities.
     *
     */
    public function indexAction(Request $request)
    {
        
        $em_four = $this->getDoctrine()->getRepository("AppBundle:fournisseurs");
        $query_four = $em_four->createQueryBuilder('F')
            ->select('F.nom')
            ->orderBy('F.nom')
            ->getQuery();
        $founisseurs = $query_four->getResult();

        $em_typeProduit = $this->getDoctrine()->getRepository("AppBundle:type_produit");
        $query_typeProduit = $em_typeProduit->createQueryBuilder('T')
            ->select('T.type')
            ->orderBy('T.type')
            ->getQuery();
        $typeProduit = $query_typeProduit->getResult();

        $date = date('Y ', time());

        $em_prod = $this->getDoctrine()->getRepository("AppBundle:produits");
        $query = $em_prod->createQueryBuilder('P')
            ->select('P')
            ->where('SUBSTRING (P.date,1,4) LIKE SUBSTRING(:date,1,4)')
            ->setParameter('date', $date)
            ->orderBy('P.prixVend','DESC')->getQuery();
        $paginator=$this->get('knp_paginator');
        $produits=$paginator->paginate(
            $query,
            $request->query->getInt('page',1),
            6
        );

        if($request->getMethod() == 'POST')
    {
    
            $query=$reprostiry->createQueryBuilder('produits')
                ->select('produits')
                ->where('produits.prixVend = ?1')

                ->orderBy('produits.prixVend','DESC')->getQuery();
            $paginator=$this->get('knp_paginator');
            $produits=$paginator->paginate(
                $query,
                $request->query->getInt('page',1),
                2
            );
        
            return $this->render('produits/index.html.twig', array(
                'produits' => $produits,
                'founisseurs' => $founisseurs,
                'typeProduit' => $typeProduit,
            ));}   
        return $this->render('produits/index.html.twig', array(
            'produits' => $produits,
            'founisseurs' => $founisseurs,
            'typeProduit' => $typeProduit,
        ));
/*
        $em = $this->getDoctrine()->getManager();

        $produits = $em->getRepository('AppBundle:produits')->findAll();

        $formatted = [];
        foreach ($produits as $produit) {
            $formatted[] = [
               'id' => $produit->getId(),
               'fournisseur' => $produit->getFournisseurs()->__toString() ,
               'type' => $produit->getTypeProduit()->getType(),
               'nom' => $produit->getNom(),
               'prix_achat' => $produit->getPrixAchat(),
               'prix_vent' =>  $produit->getPrixVend(),
               'date' => $produit->getDate(),
                
            ];
        }
        //Validator::validate();
        return new JsonResponse($formatted);*/
    
}

    public function rechercheAction (Request $request )
    {
        $date = date('Y ', time());
        $motcle =  $request->query->get('motcle');
        $em_prod = $this->getDoctrine()->getRepository("AppBundle:produits");
        $query = $em_prod->createQueryBuilder('P')
            ->select('P')
            ->innerjoin("AppBundle:type_produit","T" , 'WITH', 'P.type_produit = T.id')
            ->innerjoin("AppBundle:fournisseurs","F" , 'WITH', 'P.fournisseurs = F.id')
            ->where('SUBSTRING (P.date,1,4) LIKE SUBSTRING(:date,1,4) and T.type LIKE :motcle OR F.nom LIKE :motcle OR P.date LIKE :motcle ')
            ->setParameter('motcle', '%'.$motcle.'%')
            ->setParameter('date', $date)
            ->getQuery();
        $produits = $query->getResult();

        return $this->render('produits/recherche.html.twig', [
            'produits' => $produits,
            ]);
    }

    public function rechvendAction (Request $request )
    {

        $date = date('Y ', time());
        $motcle =  $request->query->get('motcle');
        $em_prod = $this->getDoctrine()->getRepository("AppBundle:produits");
        $query = $em_prod->createQueryBuilder('P')
            ->select('P')
            ->where('P.vendu LIKE :motcle and SUBSTRING (P.date,1,4) LIKE SUBSTRING(:date,1,4)')
            ->setParameter('motcle', $motcle)
            ->setParameter('date', $date)
            ->getQuery();
        $produits = $query->getResult();
          
        return $this->render('produits/recherche.html.twig', [
            'produits' => $produits,
            ]);
    }

    public function rechtypeproduitAction (Request $request )
    {

        $date = date('Y ', time());
        $motcle =  $request->query->get('motcle');
        $em_prod = $this->getDoctrine()->getRepository("AppBundle:produits");
        $query = $em_prod->createQueryBuilder('P')
            ->select('P')
            ->innerjoin("AppBundle:type_produit" , "T")
            ->where('P.type_produit = T.id and T.type LIKE :motcle and SUBSTRING (P.date,1,4) LIKE SUBSTRING(:date,1,4)')
            ->setParameter('motcle', $motcle)
            ->setParameter('date', $date)
            ->getQuery();
        $produits = $query->getResult();
          
        return $this->render('produits/recherche.html.twig', [
            'produits' => $produits,
            ]);
    }

    public function rechfournisseursAction (Request $request )
    {

        $date = date('Y ', time());
        $motcle =  $request->query->get('motcle');
        $em_prod = $this->getDoctrine()->getRepository("AppBundle:produits");
        $query = $em_prod->createQueryBuilder('P')
            ->select('P')
            ->innerjoin("AppBundle:fournisseurs" , "F")
            ->where('P.fournisseurs = F.id and F.nom LIKE :motcle and SUBSTRING (P.date,1,4) LIKE SUBSTRING(:date,1,4)')
            ->setParameter('motcle', $motcle)
            ->setParameter('date', $date)
            ->getQuery();
        $produits = $query->getResult();
          
        return $this->render('produits/recherche.html.twig', [
            'produits' => $produits,
            ]);
    }

    public function addvendAction($id_prod)
    {

        $response = $this->forward('AppBundle:vende:new', array(
            'id_prod' => $id_prod,
        ));

        return $response;
    }

    public function updatevendu ($id , $id_prod)
    {
        
        return $this->forward('AppBundle:vende:show', array('id' => $id));
    }

    /**
     * Creates a new produit entity.
     *
     */
    public function newAction(Request $request)
    {
        $produit = new Produits();
        $form = $this->createForm('AppBundle\Form\produitsType', $produit);
        $form->handleRequest($request);
        //$date = date('Y ', time());
        if ($form->isSubmitted() && $form->isValid()) {
            $produit ->setDate(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();

            return $this->redirectToRoute('produits_show', array('id' => $produit->getId()));
        }

        return $this->render('produits/new.html.twig', array(
            'produit' => $produit,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a produit entity.
     *
     */
    public function showAction(produits $produit)
    {
        $deleteForm = $this->createDeleteForm($produit);

        return $this->render('produits/show.html.twig', array(
            'produit' => $produit,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing produit entity.
     *
     */
    public function editAction(Request $request, produits $produit)
    {
        $deleteForm = $this->createDeleteForm($produit);
        $editForm = $this->createForm('AppBundle\Form\produitsType', $produit);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('produits_edit', array('id' => $produit->getId()));
        }

        return $this->render('produits/edit.html.twig', array(
            'produit' => $produit,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a produit entity.
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        if(!$id)
        {
            throw $this->createNotFoundException('No ID found');
        }

        $movie = $this->getDoctrine()->getEntityManager()->getRepository('AppBundle:produits')->Find($id);

        if($movie != null)
        {
            $em->remove($movie);
            $em->flush();
        }

        return $this->redirectToRoute('produits_index');
    }

    /**
     * Creates a form to delete a produit entity.
     *
     * @param produits $produit The produit entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(produits $produit)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('produits_delete', array('id' => $produit->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
