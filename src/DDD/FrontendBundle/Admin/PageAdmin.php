<?php

namespace DDD\FrontendBundle\Admin;

use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use DDD\CoreDomain\Page\Page;
use DDD\CoreDomain\Page\Tags;
use DDD\CoreDomain\Page\Status;
use DDD\CoreDomain\DTO\PublishPageCommand;
use DDD\CoreDomain\DTO\CreatePageCommand;
use DDD\FrontendBundle\Form\Type\TagsType;
use DDD\FrontendBundle\Form\Type\StatusType;
use DDD\FrontendBundle\Form\Type\PageType;
use DDD\FrontendBundle\Form\DataTransformer\PageTransformer;

/**
 * Class PageAdmin
 */
class PageAdmin extends Admin
{
    protected $baseRouteName = 'DDD\CoreDomain\DTO\CreatePageCommand';
    protected $baseRoutePattern = 'page';

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('slug', 'text', ['attr' => ['data' => 'title']])
            ->add('withBody', 'textarea', ['attr' => ['data' => 'body']])
            ->add('withTitle', 'text', ['attr' => ['data' => 'slug']])
            ->add('status', new StatusType())
            ->add('tags', new TagsType(), ['required' => false]);
        $builder = $formMapper->getFormBuilder();
        $builder->addViewTransformer(new PageTransformer($this->modelManager));
    }

    /**
     * @param ShowMapper $showMapper
     */
    public function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('slug')
            ->add('withTitle');
        //->add('status');
    }

    /**
     * @param ListMapper $listMapper
     */
    public function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('slug')
            ->add('withTitle');
        //->add('withStatus');
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    public function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('slug');
        //->add('title')
        //->add('status');
    }

    public function getNewInstance()
    {
        if ($this->hasRequest() && ($uniqid = $this->getRequest()->get('uniqid'))) {
            $data  = $this->getRequest()->request->get($uniqid);
            $title = $data['withTitle'];
            $body  = $data['withBody'];
            $slug  = $data['slug'];
            //$description = $data['withTags']['description'];
            //$keywords    = $data['withTags']['keywords'];
            //$status      = $data['withStatus']['name'];
            $description  = null;
            $keywords     = null;
            $status       = new PublishPageCommand();
            $status->name = $data['status']['name'];
        } else {
            $title       = null;
            $body        = null;
            $slug        = null;
            $description = null;
            $keywords    = null;
            $status      = new PublishPageCommand();
        }
        $publishPageCommand = new CreatePageCommand(
            $title,
            $body,
            $slug,
            new Tags($description, $keywords),
            $status
        );

        return $publishPageCommand;
    }
}