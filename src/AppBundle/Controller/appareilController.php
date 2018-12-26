<?php

namespace AppBundle\Controller;

use AppBundle\Entity\appareil;
use AppBundle\Form\appareilType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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

            return $this->redirectToRoute('appareil_edit', array('id' => $appareil->getId()));
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
