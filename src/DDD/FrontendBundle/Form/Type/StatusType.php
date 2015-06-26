<?php

namespace DDD\FrontendBundle\Form\Type;

use DDD\CoreDomain\Page\Status;
use DDD\CoreDomain\Page\Statuses;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use DDD\FrontendBundle\Form\DataTransformer\PublishPageTransformer;

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
                          'error_bubbling' => false
                      ]
            );
        $builder->addViewTransformer(new PublishPageTransformer());
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class'           => 'DDD\CoreDomain\DTO\PublishPageCommand',
                'extra_fields_message' => 'This form should not contain extra fields: {{ extra_fields }}'
            )
        );
    }
}