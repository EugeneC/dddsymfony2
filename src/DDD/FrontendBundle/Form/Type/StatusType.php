<?php

namespace DDD\FrontendBundle\Form\Type;

use DDD\CoreDomain\Page\Statuses;
use DDD\FrontendBundle\Form\DataTransformer\StatusTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class StatusType
 *
 * @package DDD\FrontendBundle\Form\Type
 */
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
                'name', 'choice', [
                          'attr'           => ['data' => 'status', 'style' => 'width:150px'],
                          'data_class'     => null,
                          'choices'        => Statuses::getAsArray(),
                          'required'       => true,
                          'error_bubbling' => false,
                          'label'          => false
                      ]
            );
        $builder->addViewTransformer(new StatusTransformer());
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class'           => 'DDD\CoreDomain\DTO\UpdatePageWithStatusCommand',
                'extra_fields_message' => 'This form should not contain extra fields: {{ extra_fields }}'
            )
        );
    }
}