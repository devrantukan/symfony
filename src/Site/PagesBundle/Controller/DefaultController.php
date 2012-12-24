<?php

namespace Site\PagesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Site\PagesBundle\Model\PagesQuery;
use Site\PagesBundle\Model\Pages;

class DefaultController extends Controller
{
	public function indexAction($name)
	{
		return $this->render('SitePagesBundle:Default:index.html.twig', array('name' => $name));
	}

	public function showAction($slug)
	{
		$request = $this->getRequest();
		$locale = $request->getLocale();
		 
		$master = PagesQuery::create()
		->filterBySlug($slug)
		->findOne();
		 
		$master_id = $master->getMasterId();
		 
		$pages = PagesQuery::create()
		->filterByLang($locale)
		->filterByMasterId($master_id)
		->findOne();
		 

		$apo_dayi = $pages->getSlug();
		 
		$uri = $this->generateUrl('_site_pages',array('slug' => $apo_dayi));
			
		if($slug != $apo_dayi)
		{
			return $this->redirect($uri);
		}
		
		// 'bundles/sitepages/images/big-slide01.jpeg', 'bundles/sitepages/images/big-slide02.jpeg'
		

		$images = explode(',', $pages->getImages());
		
		$duyurular = $this->retrieveTweetsAction('devrantukan', 'instagram');

		$ilanlar = $this->retrieveTweetsAction('devrantukan', 'webstagram');
		
		 
		return $this->render('SitePagesBundle:Default:show.html.twig', array('pages' => $pages, 'ilanlar' => $ilanlar, 'duyurular' => $duyurular , 'images' => $images));
	}

	public function retrieveTweetsAction($username, $hashtag)
	{
		$user = $username;
		$hashtag = $hashtag;
		$limit = 50;
		 
		$url = "http://api.twitter.com/1/statuses/user_timeline.json?screen_name=".urlencode($user)."&trim_user=true&count=".intval($limit);
		$json_data = json_decode(file_get_contents($url));
		 
		$arrTwet = array();

		for($i=0; $i<=$limit; $i++)
		{
			if (isset( $json_data[$i] ))
			{
				$text = $json_data[$i]->text;
				 
				if(preg_match("/".$hashtag."/i", $text))
				{
					//$text= preg_replace("/(^|[\n ])([\w]*?)((ht|f)tp(s)?:\/\/[\w]+[^ \,\"\n\r\t<]*)/is", "$1$2<a href=\"$3\" >$3</a>", $text);
					//$text= preg_replace("/(^|[\n ])([\w]*?)((www|ftp)\.[^ \,\"\t\n\r<]*)/is", "$1$2<a href=\"http://$3\" >$3</a>", $text);
					//$text= preg_replace("/(^|[\n ])([a-z0-9&\-_\.]+?)@([\w\-]+\.([\w\-\.]+)+)/i", "$1<a href=\"mailto:$2@$3\">$2@$3</a>", $text);
					$text = preg_replace("/((http(s?):\/\/)|(www\.))([\w\.]+)([a-zA-Z0-9?&%.;:\/=+_-]+)/i", "<a href='http$3://$4$5$6' target='_blank'>$2$4$5$6</a>", $text);
					
					$text = rtrim( preg_replace('/#[^\s]+\s?/', '', $text) );
					//$text = preg_replace('/((www|http:\/\/)\S+)/', '<a href="$1">$1</a>', $text);
					//$text = preg_replace("/http:\/\/(.*?)\/\.?$/", "<a target=\"_blank\" href=\"http://$1\">http://$1</a>", $text);
					$arrTwet[] = $text;
				}
			}
		}
		return $arrTwet;
			
		 
	}
	 
	 
}
