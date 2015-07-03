<?php
namespace DDD\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class PageController
 *
 * @package DDD\FrontendBundle\Controller
 */
class PageController extends Controller
{
    /**
     * @param string $pageSlug
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \DDD\CoreDomain\Page\PublishedPageNotFoundException
     */
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
