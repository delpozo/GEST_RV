<?php

namespace AppBundle\Controller;

use AppBundle\Entity\vende;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Vende controller.
 *
 */
class vendeController extends Controller
{
    /**
     * Lists all vende entities.
     *
     */
    public function indexAction(Request $request)
    {
        // $date = date('Y ', time());

        // $reprostiry=$this->getDoctrine()->getRepository("AppBundle:vende");
        // $query=$reprostiry->createQueryBuilder('vende')->select('vende')
        // ->where('SUBSTRING (vende.date,1,4) LIKE SUBSTRING(:date,1,4)')
        //     ->setParameter('date', $date)
        //     ->orderBy('vende.prixVend','DESC')->getQuery();
        // $paginator=$this->get('knp_paginator');
        // $vendes=$paginator->paginate(
        //     $query,
        //     $request->query->getInt('page',1),
        //     6
        // );

        /*if($request->getMethod() == 'POST')
        {
            $query=$reprostiry->createQueryBuilder('vende')->select('vende')
                ->where('vende.prixVend = ?1')

                ->orderBy('vende.prixVend','DESC')->getQuery();
            $paginator=$this->get('knp_paginator');
            $vendes=$paginator->paginate(
                $query,
                $request->query->getInt('page',1),
                2
            );
        
            return $this->render('vende/index.html.twig', array(
                'vendes' => $vendes,
            ));}    
            
            return $this->render('vende/index.html.twig', [
        'vendes' => $vendes,

    ]);*/

    $em = $this->getDoctrine()->getManager();

    $vendes = $em->getRepository('AppBundle:vende')->findAll();

        $formatted = [];
        foreach ($vendes as $vent) {
            $formatted[] = [
               'id' => $vent->getId(),
               'user' => $vent->getUser()->getNom() ,
               'prix_vent' =>  $vent->getPrixVend(),
               'date_ac' => $vent->getDateAc(),
               'date_ex' => $vent->getDateEx(),
               'email' => $vent->getEmail(),
               'num_tel' => $vent->getNumTel(),
               'num_fix' => $vent->getNumFix(),
               'nom_prod' => $vent->getProduits()->getNom(),
               'nom_client' => $vent->getNompreCli(),
               'adress' => $vent->getadress(),
               'credit' => $vent->getCredit(),
               'rest_pay' => $vent->getRestPay(),
               'deponse' => $vent->getdeponse(),
               'date' => $vent->getDate(),
               'abonner' => $vent->getAbonner(),
                
            ];
        }
        //Validator::validate();
        return new JsonResponse($formatted);
    

    }
    
    public function rechercheAction (Request $request )
    {

        $motcle =  $request->query->get('motcle');
        $em_prod = $this->getDoctrine()->getRepository("AppBundle:vende");
        $query = $em_prod->createQueryBuilder('V')
            ->select('V')
            ->where('V.nompreCli LIKE :motcle OR V.numTel LIKE :motcle OR V.numFix LIKE :motcle OR V.adress LIKE :motcle OR V.email LIKE :motcle OR V.dateAc LIKE :motcle OR V.prixVend LIKE :motcle')
            ->setParameter('motcle', '%'.$motcle.'%')
            ->getQuery();
        $recherch = $query->getResult();
          
        return $this->render('vende/recherche.html.twig', [
            'vendes' => $recherch,
            ]);
    }

    public function rechcreditAction (Request $request )
    {

        $date = date('Y ', time());
        $motcle =  $request->query->get('motcle');
        $em_prod = $this->getDoctrine()->getRepository("AppBundle:vende");
        $query = $em_prod->createQueryBuilder('V')
            ->select('V')
            ->where('V.restPay > 0 and SUBSTRING (V.date,1,4) LIKE SUBSTRING(:date,1,4)')
            ->setParameter('date', $date)
            ->getQuery();
        $vendes = $query->getResult();
          
        return $this->render('vende/recherche.html.twig', [
            'vendes' => $vendes,
            ]);
    }

    public function rechvendExAction (Request $request )
    {

        $em = $this->getDoctrine()->getRepository("AppBundle:vende");
        $time = date("Y-m-d H:i:s");

        $query2 = $em->createQueryBuilder('V')
            ->select( 'V')
            ->where('V.dateEx <= :date and V.dateEx >= :datee' )
            ->setParameter('date',new \DateTime('+30 day'))
            ->setParameter('datee',$time)->getQuery();

        $vendEx = $query2->getResult();

        return $this->render('vende/recherche.html.twig', [
            'vendes' => $vendEx,
            ]);
    }
/*
public function rechercheAction(Request $request)
{

if($request->isXmlHttpRequest())
{
    $motcle = '';
    $motcle =  $request->query->get('motcle');

    $em_prod = $this->getDoctrine()->getRepository("AppBundle:vende");

    if($motcle != '')
    {
        $query = $em_prod->createQueryBuilder('V')
            ->select('V.nompreCli as nom')
            ->where('V.nompreCli LIKE :motcle ')
            ->setParameter('motcle', '%'.$motcle.'%')
            ->getQuery();
        $recherch = $query->getResult();
    }

    return $this->render('vende/recherche.html.twig', [
        'recherche' => $recherch,
    ]);
}

}*/

    /**
     * Creates a new vende entity.
     *
     */
    public function newAction(Request $request , $id_prod)
    {
        $vende = new Vende();
        $form = $this->createForm('AppBundle\Form\vendeType', $vende);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        //recuperation du current user
        $currentuser = $this->getUser();
        $id_user = $currentuser->getId();
        $user = $em->getRepository('AppBundle:User')->findOneById($id_user);
        $produit = $em->getRepository('AppBundle:produits')->findOneById($id_prod);

        if ($form->isSubmitted() && $form->isValid()) {
            //add user il form
            $vende ->setProduits($produit);
            if ($vende ->getdeponse())
            {
               $restpay = floatval($vende ->getPrixVend()) - floatval( $vende ->getdeponse());
            }
            else {
                    $restpay = null;
            }
            
            $adddate = '+'.$vende -> getAbonner() . ' month' ;
            $vende ->setUser($user)->setRestPay($restpay)->setDate(new \DateTime())->setDateAc(new \DateTime())->setDateEx(new \DateTime($adddate));
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
            return $this->redirectToRoute('vende_show', array('id' => $vende->getId()));
        }

        return $this->render('vende/new.html.twig', array(
            'vende' => $vende,
            'produit' => $produit,
            'form' => $form->createView(),
        ));
    }


    /**
     * Finds and displays a vende entity.
     *
     */
    public function showAction(vende $vende)
    {
        $deleteForm = $this->createDeleteForm($vende);

        return $this->render('vende/show.html.twig', array(
            'vende' => $vende,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing vende entity.
     *
     */
    public function editAction(Request $request, vende $vende)
    {
        $deleteForm = $this->createDeleteForm($vende);
        $editForm = $this->createForm('AppBundle\Form\vendeType', $vende);
        $editForm->handleRequest($request);
        //recuperation du current user
        $em = $this->getDoctrine()->getManager();
        $currentuser = $this->getUser();
        $id_user = $currentuser->getId();
        $user = $em->getRepository('AppBundle:User')->findOneById($id_user);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            if ($vende ->getdeponse() )
            {
               $restpay = floatval($vende ->getPrixVend()) - floatval( $vende ->getdeponse());
               $vende ->setCredit('1')->setRestPay($restpay);
            }
            $vende ->setUser($user);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vende_edit', array('id' => $vende->getId()));
        }

        return $this->render('vende/edit.html.twig', array(
            'vende' => $vende,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a vende entity.
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        if(!$id)
        {
            throw $this->createNotFoundException('No ID found');
        }

        $movie = $this->getDoctrine()->getEntityManager()->getRepository('AppBundle:vende')->Find($id);

        if($movie != null)
        {
            $em->remove($movie);
            $em->flush();
        }

        return $this->redirectToRoute('vende_index');
    }

    /**
     * Creates a form to delete a vende entity.
     *
     * @param vende $vende The vende entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(vende $vende)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('vende_delete', array('id' => $vende->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
