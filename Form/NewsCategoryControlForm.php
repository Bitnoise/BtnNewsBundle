<?php

namespace Btn\NewsBundle\Form;

use Btn\AdminBundle\Form\AbstractForm;
use Symfony\Component\Form\FormBuilderInterface;

class NewsCategoryControlForm extends AbstractForm
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('title', null, array(
                'label' => 'btn_news.news_category.title',
            ))
            ->add('slug', null, array(
                'label' => 'btn_news.news_category.slug',
            ))
            ->add('visible', null, array(
                'label' => 'btn_news.news_category.visible',
            ))
            ->add('position', null, array(
                'label' => 'btn_news.news_category.position',
            ))
            ->add('save', $options['data']->getId() ? 'btn_save' : 'btn_create')
        ;
    }

    public function getName()
    {
        return 'btn_news_form_news_category_control';
    }
}
