<?php

namespace DDD\FrontendBundle\Form\Type;

use DDD\CoreDomain\Page\Tags;
use DDD\FrontendBundle\Form\DataTransformer\MetaTagsTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class TagsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'tags_type';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description', 'text', ['required' => false])
            ->add('keywords', 'text', ['required' => false]);
        $builder->addViewTransformer(new MetaTagsTransformer());
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class'           => 'DDD\CoreDomain\DTO\UpdatePageWithMetaTagsCommand',
                'extra_fields_message' => 'This form should not contain extra fields: {{ extra_fields }}'
            )
        );
    }
}