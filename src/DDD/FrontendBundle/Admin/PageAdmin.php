<?php

namespace DDD\FrontendBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use DDD\CoreDomain\Page\Statuses;
use DDD\CoreDomain\DTO\UpdatePageWithStatusCommand;
use DDD\CoreDomain\DTO\UpdatePageWithMetaTagsCommand;
use DDD\CoreDomain\DTO\AddPageCommand;
use DDD\FrontendBundle\Form\Type\TagsType;
use DDD\FrontendBundle\Form\Type\StatusType;
use DDD\FrontendBundle\Form\DataTransformer\PageTransformer;

/**
 * Class PageAdmin
 */
class PageAdmin extends Admin
{
    protected $baseRouteName = 'Page';
    protected $baseRoutePattern = 'page';
    protected $classnameLabel = 'Page';
    protected $formOptions = array(
        'cascade_validation' => true
    );

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('slug', 'text')
            ->add('withTitle', 'text', ['label' => 'Title'])
            ->add('withBody', 'textarea', ['label' => 'Body'])
            ->add('status', new StatusType())
            ->add('tags', new TagsType(), ['required' => false]);
        $formMapper->getFormBuilder()->addViewTransformer(new PageTransformer($this->modelManager));
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

    /**
     * Get new instance
     *
     * @return AddPageCommand
     */
    public function getNewInstance()
    {
        return new AddPageCommand(
            null,
            null,
            null,
            new UpdatePageWithMetaTagsCommand(),
            new UpdatePageWithStatusCommand()
        );
    }

    /**
     * @param \Sonata\DoctrineMongoDBAdminBundle\Datagrid\ProxyQuery $queryBuilder
     * @param string                                                 $alias
     * @param string                                                 $field
     * @param mixed                                                  $value
     *
     * @SuppressWarnings("unused")
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    public function getWithStatusFilter($queryBuilder, $alias, $field, $value)
    {
        if ($value['value'] === null) {
            return;
        }
        $queryBuilder->addOr($queryBuilder->expr()->field('status.name')->equals($value['value']));
    }
}