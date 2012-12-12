<?php

namespace Festival\GuestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FestivalGuestBundle:Default:index.html.twig', array('name' => "Guest User"));
    }
}
