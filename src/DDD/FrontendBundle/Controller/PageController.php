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
        $page = $this->getPageService()->findPublishedBySlug($pageSlug);

        return $this->render('DDDFrontendBundle:Page:pageTemplate.html.twig', array('page' => $page));
    }

    /**
     * @return \DDD\CoreDomain\Page\PageService
     */
    public function getPageService()
    {
        return $this->get('page_service');
    }
}
