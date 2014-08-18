<?php

namespace Btn\NewsBundle\Form;

use Btn\AdminBundle\Form\AbstractForm;
use Symfony\Component\Form\FormBuilderInterface;

class NewsControlForm extends AbstractForm
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('title', null, array(
                'label' => 'btn_news.news.title',
            ))
            ->add('slug', 'btn_slug', array(
                'label' => 'btn_news.news.slug',
            ))
            ->add('preview', null, array(
                'label' => 'btn_news.news.preview',
            ))
            ->add('text', null, array(
                'label' => 'btn_news.news.text',
            ))
            ->add('category', 'btn_news_category', array(
                'label' => 'btn_news.news.category',
            ))
            ->add('created_at', 'btn_datetime', array(
                'label' => 'btn_news.news.created_at',
            ))
            ->add('save', $options['data']->getId() ? 'btn_save' : 'btn_create')
        ;
    }

    public function getName()
    {
        return 'btn_news_form_news_control';
    }
}
