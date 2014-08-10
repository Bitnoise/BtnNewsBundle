<?php

namespace Btn\NewsBundle\Form;

use Btn\AdminBundle\Form\AbstractForm;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewsCategoryType extends AbstractForm
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

    public function getName()
    {
        return 'btn_news_newscategory_form';
    }
}
