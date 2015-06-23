<?php

namespace DDD\FrontendBundle\Form\Type;

use DDD\CoreDomain\Page\Status;
use DDD\CoreDomain\Page\Statuses;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StatusType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'status_type';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name', 'choice', array(
                'attr'       => array('data' => 'status', 'style' => 'width:150px'),
                'data_class' => null,
                'choices'    => array(
                    Statuses::PUBLISH => Statuses::PUBLISH,
                    Statuses::DRAFT   => Statuses::DRAFT
                ),
                'required'   => true
            )
            );
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'DDD\CoreDomain\Page\Status',
                'empty_data' => function (FormInterface $form) {
                    return new Status(
                        $form->get('name')->getData()
                    );
                }
            )
        );
    }
}