<?php

namespace DDD\FrontendBundle\Form\Type;

use DDD\CoreDomain\Page\Page;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;

class PageType extends AbstractType
{
    public function getName()
    {
        return 'page_type';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text')
            ->add('body', 'text')
            ->add('slug', 'text')
            ->add('tags', new TagsType());
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'DDD\CoreDomain\Page\Page',
                'empty_data' => function (FormInterface $form) {
                    return new Page(
                        $form->get('title')->getData(),
                        $form->get('body')->getData(),
                        $form->get('slug')->getData(),
                        $form->get('tags')->getData()
                    );
                }
            )
        );
    }
}