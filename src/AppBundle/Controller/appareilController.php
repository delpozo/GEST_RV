<?php

namespace AppBundle\Controller;

use AppBundle\Entity\appareil;
use AppBundle\Form\appareilType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Appareil controller.
 *
 */
class appareilController extends Controller
{
    /**
     * Lists all appareil entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $appareils = $em->getRepository('AppBundle:appareil')->findAll();

         return $this->render('appareil/index.html.twig', array(
            'appareils' => $appareils,
        ));
        /* $formatted = [];
        foreach ($appareils as $appareil) {
            $formatted[] = [
               'id' => $appareil->getId(),
               'code' => $appareil->getCode(),
               'nom' => $appareil->getNom(),
               'accessoir' => $appareil->getAccessoir(),
               'date_entre' => $appareil->getDateEntre(),
               'probleme' => $appareil->getProbleme(),
               'etat' =>  $appareil->getEtat(),
               'piece_changer' => $appareil->getPieceChanger(),
               'prix' => $appareil->getPrix(),
               'client' => $appareil->getClient()->getNumTel(),
               'credit' => $appareil->getCredit(), 
               'deponse' => $appareil->getDeponse(), 
            ];
        }
        //Validator::validate();
        return new JsonResponse($formatted); */
                                                         
    }

    /**
     * Creates a new appareil entity.
     *
     */
    public function newAction(Request $request)
    {
        $appareil = new Appareil();
        $form = $this->createForm('AppBundle\Form\appareilType', $appareil);
        $form->handleRequest($request);
        $problem =  $request->query->get('problem');
        if ($form->isSubmitted() && $form->isValid()) {
            $appareil->setProbleme($problem);

            $em = $this->getDoctrine()->getManager();
            $em->persist($appareil);
            $em->flush();

            return $this->redirectToRoute('appareil_show', array('id' => $appareil->getId()));
        }

        return $this->render('appareil/new.html.twig', array(
            'appareil' => $appareil,
            'form' => $form->createView(),
        ));
    }

    public function newappareilAction(Request $request)
    {
        $appareil = new Appareil();
        $problem =  $request->query->get('problem');
        $nom =  $request->query->get('nom');
        $clien =  $request->query->get('client');
        $accessoir =  $request->query->get('accessoir');
        $piece =  $request->query->get('piece');
        $deponse =  $request->query->get('deponse');
        $em_client = $this->getDoctrine()->getRepository("AppBundle:client")
        ->findOneById($clien);
        $etat =  $request->query->get('etat');
        $prix =  $request->query->get('prix');
        if ($deponse != 0 && $prix != 0)
            {
                $credit = $prix-$deponse ;
            }
        else $credit = $prix;
            $appareil->setProbleme(explode(', ', $problem))->setNom($nom)->setClient($em_client)->setEtat($etat)->setPrix($prix)
                        ->setAccessoir(explode(', ', $accessoir))->setPieceChanger(explode(', ', $piece))->setDeponse($deponse)->setCredit($credit)->setDateEntre(new \DateTime())->setCode(self::generateRandomString(6));

            $em = $this->getDoctrine()->getManager();
            $em->persist($appareil);

            $em->flush();
            
            $em_app = $this->getDoctrine()->getRepository("AppBundle:appareil");
            $query = $em_app->createQueryBuilder('A')
            ->select('SUM(A.deponse) as deponse', 'SUM(A.credit) as credit')
            ->where('A.client = :id_client')
            ->setParameter('id_client', $em_client->getId())
            ->getQuery();

            $depcre = $query->getResult();

            $em_app = $this->getDoctrine()->getRepository("AppBundle:client");
            $query = $em_app->createQueryBuilder('C')
            ->update('AppBundle:client' , 'C')
            ->set('C.deponse ' , ':deponse')
            ->set('C.credit ' , ':credit')
            ->where('C.id = :id_client')
            ->setParameter('deponse', $depcre['0']['deponse'])
            ->setParameter('credit', $depcre['0']['credit'])
            ->setParameter('id_client', $em_client->getId())
            ->getQuery();

        $client = $query->execute();

            //$em_client->setDeponse($depcre['0']['deponse'])->setCredit($depcre['0']['credit']);

            return $this->redirectToRoute('appareil_show', array('id' => $appareil->getId()));
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
     * Modifier Appareil
     */

    public function updateappareilAction($appareilId , Request $request)
    {
        //var_dump($appareilId);
        $problem =  $request->query->get('problem');
        $nom =  $request->query->get('nom');
        $clien =  $request->query->get('client');
        $accessoir =  $request->query->get('accessoir');
        $piece =  $request->query->get('piece');
        $deponse =  $request->query->get('deponse');
        $etat =  $request->query->get('etat');
        $prix =  $request->query->get('prix');
        $em_client = $this->getDoctrine()->getRepository("AppBundle:client")
        ->findOneById($clien);

        $entityManager = $this->getDoctrine()->getManager();
        $appareil = $this->getDoctrine()->getEntityManager()->getRepository('AppBundle:appareil')->Find($appareilId);
       
        //var_dump($appareil);
            if (!$appareilId) {
                throw $this->createNotFoundException(
                    'No product found for id '.$appareilId
                );
            }
            if ($deponse != 0 && $prix != 0)
            {
                $credit = $prix-$deponse ;
            }
            else $credit = $prix;

            $appareil->setProbleme(explode(', ', $problem))->setNom($nom)->setClient($em_client)->setEtat($etat)->setPrix($prix)
                        ->setAccessoir(explode(', ', $accessoir))->setPieceChanger(explode(', ', $piece))->setDeponse($deponse)->setCredit($credit)->setDateEntre($appareil->getDateEntre())->setCode($appareil->getCode());

        $entityManager->flush();
    
        return $this->redirectToRoute('appareil_show', array('id' => $appareil->getId()));
    }

    /**
     * Finds and displays a appareil entity.
     *
     */
    public function showAction(appareil $appareil)
    {
        $deleteForm = $this->createDeleteForm($appareil);

        return $this->render('appareil/show.html.twig', array(
            'appareil' => $appareil,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing appareil entity.
     *
     */
    public function editAction(Request $request, appareil $appareil)
    {
        //var_dump($appareil);
        $deleteForm = $this->createDeleteForm($appareil);
        $editForm = $this->createForm('AppBundle\Form\appareilType', $appareil);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('appareil/appareil_edit', array('id' => $appareil->getId()));
        }

        return $this->render('appareil/edit.html.twig', array(
            'appareil' => $appareil,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a appareil entity.
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        if(!$id)
        {
            throw $this->createNotFoundException('No ID found');
        }

        $movie = $this->getDoctrine()->getEntityManager()->getRepository('AppBundle:appareil')->Find($id);

        if($movie != null)
        {
            $em->remove($movie);
            $em->flush();
        }

        return $this->redirectToRoute('appareil_index');
    }

    /**
     * Creates a form to delete a appareil entity.
     *
     * @param appareil $appareil The appareil entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(appareil $appareil)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('appareil_delete', array('id' => $appareil->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
