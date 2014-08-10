<?php

namespace Btn\NewsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewsCategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, array(
                'label' => 'news_category.title',
            ))
            ->add('slug', null, array(
                'label' => 'news_category.slug',
            ))
            ->add('visible', null, array(
                'label' => 'news_category.visible',
            ))
            ->add('position', null, array(
                'label' => 'news_category.position',
            ))
            ->add('save', $options['data']->getId() ? 'btn_admin_save_button' : 'btn_admin_create_button')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Btn\\NewsBundle\\Entity\\NewsCategory',
        ));
    }

    public function getName()
    {
        return 'btn_newsbundle_newscategory';
    }
}
