<?php

namespace Btn\NewsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('slug', null, array(
                'label' => 'news.slug',
            ))
            ->add('title', null, array(
                'label' => 'news.title',
            ))
            ->add('preview', null, array(
                'label' => 'news.preview',
            ))
            ->add('text', null, array(
                'label' => 'news.text',
            ))
            ->add('category', null, array(
                'label' => 'news.category',
            ))
            ->add('created_at', 'date', array(
                'label' => 'news.created_at',
            ))
            ->add('save', $options['data']->getId() ? 'btn_save' : 'btn_create')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Btn\\NewsBundle\\Entity\\News',
        ));
    }

    public function getName()
    {
        return 'btn_newsbundle_newstype';
    }
}
