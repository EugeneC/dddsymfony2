<?php

namespace DDD\FrontendBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

/**
 * Class UserAdmin
 */
class UserAdmin extends Admin
{
    protected $baseRouteName = 'User';
    protected $baseRoutePattern = 'user';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
                ->add('username', 'text', array('attr' => array('data' => 'username')))
                ->add('email', 'text', array('attr' => array('data' => 'email')))
                ->add('plainPassword', 'text', array('required' => false, 'attr' => array('data' => 'plainPassword')))
                ->add('enabled', 'checkbox', array('required' => false, 'attr' => array('data' => 'enabled')))
                ->add('locked', 'checkbox', array('required' => false, 'attr' => array('data' => 'locked')))
            ->end()
            ->with('Management')
                ->add(
                    'roles', 'choice', [
                               'choices'  => [
                                   'ROLE_SUPER_ADMIN' => $this->trans('Super admin'),
                                   'ROLE_ADMIN' => 'Admin'
                               ],
                               'multiple' => true,
                               'expanded' => true,
                               'required' => false
                           ]
                )
            ->end();

    }

    /**
     * @param ListMapper $listMapper
     */
    public function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('email')
            ->add('username')
            ->add('enabled')
            ->add('locked')
            ->add('lastLogin');
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    public function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('email')
            ->add('username')
            ->add('enabled');
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($user)
    {
        $this->getUserManager()->updateCanonicalFields($user);
        $this->getUserManager()->updatePassword($user);
    }

    /**
     * @param UserManagerInterface $userManager
     */
    public function setUserManager($userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * @return UserManagerInterface
     */
    public function getUserManager()
    {
        return $this->userManager;
    }
}
