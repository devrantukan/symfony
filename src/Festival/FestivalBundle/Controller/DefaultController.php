<?php

namespace Festival\FestivalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//queries
use Festival\FestivalBundle\Model\FestivalQuery;
use Festival\FestivalBundle\Model\FestivalContentQuery;
use Festival\FestivalBundle\Model\FestivalLocationQuery;
use Festival\FestivalBundle\Model\FestivalLocationContentQuery;
use Festival\FestivalBundle\Model\FestivalTypeQuery;
use Festival\FestivalBundle\Model\FestivalUrlQuery;
use Festival\FestivalBundle\Model\FestivalUrlTypeQuery;




use Symfony\Component\HttpFoundation\Request;
//objects
use Festival\FestivalBundle\Model\Festival;
use Festival\FestivalBundle\Model\FestivalContent;
use Festival\FestivalBundle\Model\FestivalLocation;
use Festival\FestivalBundle\Model\FestivalLocationContent;
use Festival\FestivalBundle\Model\FestivalType;
use Festival\FestivalBundle\Model\FestivalUrl;
use Festival\FestivalBundle\Model\FestivalUrlType;


//forms
//use Festival\FestivalBundle\Form\Type\FestivalType;


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
        
        $festival_content = FestivalContentQuery::create()
        ->filterByFestivalId($festival->getId())
        ->findOne();
        
       $festival_location = FestivalLocationQuery::create()
       ->filterById($festival->getFestivalLocationId())
       ->findOne();
       
       $festival_location_content = FestivalLocationContentQuery::create()
       ->filterById($festival_location->getFestivalLocationContentId())
       ->findOne();

        $festival_url = FestivalUrlQuery::create()
        ->filterByFestivalId($festival->getFestivalUrlId())
        ->findOne();
        
        $festival_url_type = FestivalUrlTypeQuery::create()
        ->filterById($festival_url->getFestivalUrlTypeId())
        ->findOne();
  
        // After model modification getTypeId() should be renamed to getFestivalTypeId()
        $festival_type = FestivalTypeQuery::create()
        ->filterById($festival->getFestivalTypeId())
        ->findOne();


	return $this->render('FestivalFestivalBundle:Default:show.html.twig', array('festival' => $festival, 'festival_content' => $festival_content, 'festival_location' => $festival_location, 'festival_location_content' => $festival_location_content ,'festival_url' => $festival_url , 'festival_url_type' => $festival_url_type, 'festival_type' => $festival_type  ));
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
