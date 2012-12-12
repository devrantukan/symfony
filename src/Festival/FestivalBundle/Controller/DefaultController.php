<?php

namespace Festival\FestivalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Festival\FestivalBundle\Model\FestivalQuery;
use Symfony\Component\HttpFoundation\Request;
use Festival\FestivalBundle\Model\Festival;
use Festival\FestivalBundle\Form\Type\FestivalType;


class DefaultController extends Controller
{
	public function indexAction()
    {
        $request = $this->getRequest();

        $locale = $request->getLocale();
		$festivals = FestivalQuery::create()
    	->filterByLang($locale)
		->find();
	
	return $this->render('FestivalFestivalBundle:Default:index.html.twig', array('festivals' => $festivals));
    
    }
    public function showAction($slug)
    {
        $request = $this->getRequest();
        $locale = $request->getLocale();

        $festival = FestivalQuery::create()
        ->filterByLang($locale)
        ->filterBySlug($slug)
        ->findOne();

	return $this->render('FestivalFestivalBundle:Default:show.html.twig', array('festival' => $festival));
    }

    public function addAction(Request $request)
    {
	        $festival = new Festival();
	        $form = $this->createForm(new FestivalType(), $festival);
	
	            return $this->render('FestivalFestivalBundle:Default:add.html.twig', array(
	            'form' => $form->createView(),
	        ));
    }

}
