<?php

namespace DDD\FrontendBundle\Admin;

use DDD\CoreDomain\Page\Page;
use DDD\CoreDomain\Page\Tags;
use DDD\FrontendBundle\Form\Type\TagsType;
use DDD\FrontendBundle\Form\Type\StatusType;
use DDD\FrontendBundle\Form\DataTransformer\StatusToNumberTransformer;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

/**
 * Class PageAdmin
 */
class PageAdmin extends Admin
{
    protected $baseRouteName = 'DDD\CoreDomain\Page\Page';
    protected $baseRoutePattern = 'page';

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', 'text', array('attr' => array('data' => 'title')))
            ->add('body', 'textarea', array('attr' => array('data' => 'body')))
            ->add('slug', 'text', array('attr' => array('data' => 'slug')))
            ->add('status', new StatusType())
            ->add('tags', new TagsType());

        $builder = $formMapper->getFormBuilder();
        $builder->addEventListener(
            FormEvents::PRE_SUBMIT, function (FormEvent $event) {
            $data = $event->getData();
            $form = $event->getForm();
            if (!$data) {
                return;
            }
            var_dump($data);
            var_dump($form);
            $page = new Page($data['title'], $data['body'], $data['slug'], new Tags($data['tags']['description'], $data['tags']['keywords']));
            if ($status = $data['status']['name']) {
                $page->$status();
            }
            $form->setData($page);
            var_dump($form);
            //exit();

            $event->setData($page);
        }
        );
    }

    /**
     * @param ShowMapper $showMapper
     */
    public function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('slug')
            ->add('title');
        //->add('status');
    }

    /**
     * @param ListMapper $listMapper
     */
    public function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('slug')
            ->add('title');
        //->add('status');
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    public function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('slug');
        //->add('status');
    }

    public function getNewInstance()
    {
        if ($this->hasRequest() && ($uniqid = $this->getRequest()->get('uniqid'))) {
            $data        = $this->getRequest()->request->get($uniqid);
            $title       = $data['title'];
            $body        = $data['body'];
            $slug        = $data['slug'];
            $description = $data['tags']['description'];
            $keywords    = $data['tags']['keywords'];
            $status      = $data['status']['name'];
        } else {
            $title       = null;
            $body        = null;
            $slug        = null;
            $description = null;
            $keywords    = null;
            $status      = null;
        }
        $page = new Page($title, $body, $slug, new Tags($description, $keywords));
        if ($status) {
            $page->$status();
        }

        return $page;
    }
}