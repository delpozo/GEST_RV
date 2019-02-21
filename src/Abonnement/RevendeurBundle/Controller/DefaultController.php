<?php

namespace Abonnement\RevendeurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $types = $em->getRepository('AppBundle:type_produit')->findAll();

        
        return $this->render('abonn.html.twig', array(
            'type_produit' => $types,
        ));
    }
}
