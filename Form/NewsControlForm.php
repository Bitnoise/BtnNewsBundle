<?php

namespace Btn\NewsBundle\Form;

use Btn\AdminBundle\Form\AbstractForm;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewsControlForm extends AbstractForm
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('slug', null, array(
                'label' => 'btn_news.slug',
            ))
            ->add('title', null, array(
                'label' => 'btn_news.title',
            ))
            ->add('preview', null, array(
                'label' => 'btn_news.preview',
            ))
            ->add('text', null, array(
                'label' => 'btn_news.text',
            ))
            ->add('category', 'btn_newscategory', array(
                'label' => 'btn_news.category',
            ))
            ->add('created_at', 'date', array(
                'label' => 'btn_news.created_at',
            ))
            ->add('save', $options['data']->getId() ? 'btn_save' : 'btn_create')
        ;
    }

    public function getName()
    {
        return 'btn_news_form_news_control';
    }
}
