<?php

namespace DDD\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use DDD\CoreDomain\Page\Page;
use DDD\CoreDomain\Page\Tags;

class PageController extends Controller
{
    public function viewAction($pageSlug)
    {
        $page = $this->get('page_service')->findPublishedBySlug($pageSlug);
        
        return $this->render('DDDFrontendBundle:Page:pageTemplate.html.twig', array('page' => $page));
    }

    public function createAction()
    {
        $newPageTitle =  'New page';
        $newPageBody =  'Welcome to New Page';
        $newPageSlug =  'new';
        $newPageTagDescription =  null;
        $newPageTagKeywords =  null;
        
        $this->get('page_service')->addPublic($newPageTitle, $newPageBody, $newPageSlug, $newPageTagDescription, $newPageTagKeywords);
        
        /** Home page **/
        $homePageTitle =  'Home page';
        $homePageBody =  'Welcome to Home Page';
        $homePageSlug =  'home';
        $homePageTagDescription =  null;
        $homePageTagKeywords =  null;
        
        $this->get('page_service')->addPublic($homePageTitle, $homePageBody, $homePageSlug, $homePageTagDescription, $homePageTagKeywords);
        
        /** About page **/
        $aboutUsPageTitle =  'About us';
        $aboutUsPageBody =  'This is content of the page "ABOUT US"';
        $aboutUsPageSlug =  'about-us';
        $aboutUsPageTagDescription =  null;
        $aboutUsPageTagKeywords =  null;
        
        $this->get('page_service')->addDraft($aboutUsPageTitle, $aboutUsPageBody, $aboutUsPageSlug, $aboutUsPageTagDescription, $aboutUsPageTagKeywords);

        return new Response('');
    }
}
