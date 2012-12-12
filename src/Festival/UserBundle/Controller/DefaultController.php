<?php

namespace Festival\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Festival\UserBundle\Model\User;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('FestivalUserBundle:Default:index.html.twig', array('name' => $name));
    }

    public function createAction()
    {
        $user = new User();
        $user->setName('Devran');
        $user->setSurname('Tukan');
        
        $user->save();

        return new Response('Created user details '.$user->getId().$user->getName().$user->getSurname() );
    }
}
