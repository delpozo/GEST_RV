<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class homeController extends Controller
{
    public function indexAction()
    {
        

        return $this->render('base.html.twig');
    }
}
