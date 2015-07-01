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
use DDD\CoreDomain\Page\Statuses;
use DDD\CoreDomain\DTO\PublishPageCommand;
use DDD\CoreDomain\DTO\AddPageCommand;
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
        $formMapper->getFormBuilder()->addViewTransformer(new PageTransformer());
    }

    /**
     * @param ShowMapper $showMapper
     */
    public function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('slug')
            ->add('withTitle', null, ['label' => 'Title'])
            ->add('status.name', null, ['label' => 'Status'])
            ->add('withBody', null, ['label' => 'Body'])
            ->add('tags.description', null, ['label' => 'Description'])
            ->add('tags.keywords', null, ['label' => 'Keywords']);
    }

    /**
     * @param ListMapper $listMapper
     */
    public function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('slug')
            ->add('withTitle', null, ['label' => 'Title'])
            ->add('status', null, ['label' => 'Status', 'associated_property' => 'name']);
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    public function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('slug')
            ->add('withTitle', null, ['label' => 'Title'])
            ->add(
                'status.name',
                'doctrine_mongo_callback',
                [
                    'label'    => 'Status',
                    'callback' => array($this, 'getWithStatusFilter')
                ],
                'choice',
                [
                    'choices' => Statuses::getAsArray()
                ]
            );
    }

    public function getNewInstance()
    {
        return new AddPageCommand(
            null,
            null,
            null,
            new Tags(null, null),
            new PublishPageCommand()
        );
    }

    public function getWithStatusFilter($queryBuilder, $alias, $field, $value)
    {
        if ($value['value'] === null) {
            return;
        }
        $queryBuilder->addOr($queryBuilder->expr()->field('status.name')->equals($value['value']));
    }
}