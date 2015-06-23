<?php

namespace DDD\FrontendBundle\Form\Type;

use DDD\CoreDomain\Page\Tags;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
            ->add('description', 'text')
            ->add('keywords', 'text');
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'DDD\CoreDomain\Page\Tags',
                'empty_data' => function (FormInterface $form) {
                    return new Tags(
                        $form->get('description')->getData(),
                        $form->get('keywords')->getData()
                    );
                }
            )
        );
    }
}