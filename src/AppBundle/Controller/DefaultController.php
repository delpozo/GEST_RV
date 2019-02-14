<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    public function indexAction()
    {
        // juste pour ne reste pas vide ' return '
        $em = $this->getDoctrine()->getRepository("AppBundle:vende");

        $query1 = $em->createQueryBuilder('V')
            ->select('count(V)')->getQuery();
        $vende_cli = $query1->getResult();
        $v = $vende_cli["0"];

        $emm = $this->getDoctrine()->getRepository("AppBundle:produits");

        $query1 = $emm->createQueryBuilder('P')
            ->select('SUM(P.vendu)')->getQuery();
        $prod = $query1->getResult();
        $p = $prod["0"];

        $prod_not_vend=$p["1"] - $v["1"];

        $time = date("Y-m-d H:i:s");

        $query2 = $em->createQueryBuilder('V')
            ->select( 'V.dateEx as datex')
            ->where('V.dateEx <= :date and V.dateEx >= :datee' )
            ->setParameter('date',new \DateTime('+30 day'))
            ->setParameter('datee',$time)->getQuery();

        $vendEx = $query2->getResult();
        //$vendEx=$Ex[""];

        return $this->render('admin.html.twig', array(
            'vende_cli' => $vende_cli,
            'vendEx' => $vendEx,
            'prod_not_vend' => $prod_not_vend,

        ));
    }
}
