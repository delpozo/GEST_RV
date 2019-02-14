<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\statfour;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Statfour controller.
 *
 */
class statfourController extends Controller
{
    /**
     * Lists all statfour entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $statfours = $em->getRepository('AppBundle:statfour')->findAll();

        return $this->render('statfour/index.html.twig', array(
            'statfours' => $statfours,
        ));
    }

    public function addAction (Request $request , $id_four)
    {
        $em_prod = $this->getDoctrine()->getRepository("AppBundle:produits");
        $date = date('Y ', time());
        // Liste non Vendue
        $query = $em_prod->createQueryBuilder('P')
            ->select('count(V) as nb ', 'SUM(V.prixVend) as vende')
            ->innerJoin('AppBundle:vende', 'V')
            ->where('P.fournisseurs=:id AND P.id=V.produits and SUBSTRING (P.date,1,4) LIKE SUBSTRING(:date,1,4) and P.vendu = 1')
            ->setParameter('id', $id_four)
            ->setParameter('date', $date)
            ->getQuery();
        $nb_produit_vend = $query->getResult();
        // liste Vendue
        $query1 = $em_prod->createQueryBuilder('P')
            ->select('count(P) as nb ', 'SUM(P.prixAchat) as achat ', 'SUM(P.prixVend) as vende', 'SUM(P.vendu) as qte_prod')
            ->where('P.fournisseurs=:id  and SUBSTRING (P.date,1,4) LIKE SUBSTRING(:date,1,4) and P.vendu = 0')
            ->setParameter('id', $id_four)
            ->setParameter('date', $date)
            ->getQuery();
        $nb_produit_N_vend = $query1->getResult();
        $em_four = $this->getDoctrine()->getRepository("AppBundle:fournisseurs");
        $query1 = $em_four->createQueryBuilder('F')
            ->select('F.deponse', 'F.nom')
            ->where('F.id=:id ')
            ->setParameter('id', $id_four)
            ->getQuery();
        $depons = $query1->getResult();
        $deponse = floatval($depons["0"]["deponse"]);
        $credit = floatval($nb_produit_N_vend["0"]["achat"]) - $deponse["0"]["deponse"];

        // liste produits vendes
        $query = $em_prod->createQueryBuilder('P')
            ->select('P.nom', 'P.prixAchat', 'P.vendu', 'P.date')
            ->where('P.fournisseurs=:id and SUBSTRING (P.date,1,4) LIKE SUBSTRING(:date,1,4) and P.vendu = 1')
            ->setParameter('id', $id_four)
            ->setParameter('date', $date)
            ->getQuery();
        $list_produit_vend = $query->getResult();
        // liste vendes de cette fournisseur
        $query = $em_prod->createQueryBuilder('P')
            ->select('V.prixVend', 'IDENTITY(V.produits)', 'P.nom as nom', 'V.dateAc', 'V.dateEx')
            ->innerJoin('AppBundle:vende', 'V')
            ->where('P.fournisseurs=:id AND P.id=V.produits and SUBSTRING (P.date,1,4) LIKE SUBSTRING(:date,1,4)')
            ->setParameter('id', $id_four)
            ->setParameter('date', $date)
            ->getQuery();
        $list_vend = $query->getResult();

        $statfour = new Statfour();
        $form = $this->createForm('AppBundle\Form\statfourType', $statfour);
        $form->handleRequest($request);

            $statfour->setIdElem($id_four)->setNbProduitNVend($nb_produit_N_vend)->setNbProduitVend($nb_produit_vend)->setListProduitVend($list_produit_vend)->setListVend($list_vend)->setCredit($credit)->setDeponse($deponse);
            $em = $this->getDoctrine()->getManager();
            $em->persist($statfour);
            $em->flush();

            return $this->redirectToRoute('fournisseurs_show', array('id' => $id_four));
    }

    public function updateAction (Request $request , $id_four)
    {
        $date = date('Y ', time());
        $em_prod = $this->getDoctrine()->getRepository("AppBundle:produits");
        // Liste non Vendue
        $query = $em_prod->createQueryBuilder('P')
            ->select('count(V) as nb ', 'SUM(V.prixVend) as vende')
            ->innerJoin('AppBundle:vende', 'V')
            ->where('P.fournisseurs=:id AND P.id=V.produits and SUBSTRING (P.date,1,4) LIKE SUBSTRING(:date,1,4) and P.vendu = 1')
            ->setParameter('id', $id_four)
            ->setParameter('date', $date)
            ->getQuery();
        $nb_produit_vend = $query->getResult();
        // liste Vendue
        $query1 = $em_prod->createQueryBuilder('P')
            ->select('count(P) as nb ', 'SUM(P.prixAchat) as achat ', 'SUM(P.prixVend) as vende', 'count(P.vendu) as qte_prod')
            //->leftJoin('AppBundle:fournisseurs','F')
            ->where('P.fournisseurs=:id  and SUBSTRING (P.date,1,4) LIKE SUBSTRING(:date,1,4) ')
            ->setParameter('id', $id_four)
            ->setParameter('date', $date)
            ->getQuery();
        $nb_produit_N_vend = $query1->getResult();
        $em_four = $this->getDoctrine()->getRepository("AppBundle:fournisseurs");
        $query1 = $em_four->createQueryBuilder('F')
            ->select('F.deponse as deponse', 'F.nom')
            //->leftJoin('AppBundle:fournisseurs','F')
            ->where('F.id=:id ')
            ->setParameter('id', $id_four)
            //->setParameter('date',$date)
            ->getQuery();
        $depons = $query1->getResult();
        
        

        // liste produits vendes
        $query = $em_prod->createQueryBuilder('P')
            ->select('P.nom', 'P.prixAchat', 'P.vendu', 'P.date')
            //->innerJoin('AppBundle:vende','V')
            ->where('P.fournisseurs=:id and SUBSTRING (P.date,1,4) LIKE SUBSTRING(:date,1,4) ')
            ->setParameter('id', $id_four)
            ->setParameter('date', $date)
            ->getQuery();
        $list_produit_vend = $query->getResult();
        // liste vendes de cette fournisseur
        $query = $em_prod->createQueryBuilder('P')
            ->select('V.prixVend', 'IDENTITY(V.produits)', 'P.nom as nom', 'V.dateAc', 'V.dateEx')
            ->innerJoin('AppBundle:vende', 'V')
            ->where('P.fournisseurs=:id AND P.id=V.produits and SUBSTRING (P.date,1,4) LIKE SUBSTRING(:date,1,4)')
            ->setParameter('id', $id_four)
            ->setParameter('date', $date)
            ->getQuery();
        $list_vend = $query->getResult();

        //somme des produits 
        $query = $em_prod->createQueryBuilder('P')
            ->select('SUM(P.prixAchat) as achat ')
            ->innerJoin('AppBundle:vende', 'V')
            ->where('P.fournisseurs=:id AND P.id=V.produits and SUBSTRING (P.date,1,4) LIKE SUBSTRING(:date,1,4)')
            ->setParameter('id', $id_four)
            ->setParameter('date', $date)
            ->getQuery();
        $somme_produits = $query->getResult();

        $deponse = floatval($depons["0"]["deponse"]);
        $credit = floatval($somme_produits["0"]["achat"]) - $deponse;
        

        self::suppAction($id_four );

        // Mise à jour du Statfour
        $statfour = new Statfour();
        $form = $this->createForm('AppBundle\Form\statfourType', $statfour);
        $form->handleRequest($request);

        //if ($form->isSubmitted() && $form->isValid()) {
        $statfour->setIdElem($id_four)->setNbProduitNVend($nb_produit_N_vend)->setNbProduitVend($nb_produit_vend)->setListProduitVend($list_produit_vend)->setListVend($list_vend)->setCredit($credit)->setDeponse($deponse);
        $em = $this->getDoctrine()->getManager();
        $em->persist($statfour);
        $em->flush();

        return $this->redirectToRoute('fournisseurs_show', array('id' => $id_four));

    }
    /**
     * Displays a form to edit an existing statfour entity.
     *
     */
    public function editAction(Request $request, statfour $statfour)
    {
        $deleteForm = $this->createDeleteForm($statfour);
        $editForm = $this->createForm('AppBundle\Form\statfourType', $statfour);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('statfour_edit', array('id' => $statfour->getId()));
        }

        return $this->render('statfour/edit.html.twig', array(
            'statfour' => $statfour,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a statfour entity.
     *
     */
    public function suppAction($id_four)
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $query = $qb->delete('AppBundle:statfour', 'S')
            ->where('S.idElem = :idfour')
            ->setParameter('idfour', $id_four)
            ->getQuery();

        $query->execute();
    }

    /**
     * Creates a form to delete a statfour entity.
     *
     * @param statfour $statfour The statfour entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(statfour $statfour)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('statfour_delete', array('id' => $statfour->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
