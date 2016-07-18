<?php

namespace Btn\NewsBundle\Form\Filter;

use Btn\AdminBundle\Form\AbstractFilterForm;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

class NewsFilterForm extends AbstractFilterForm
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('keyword', 'text', array(
                'label' => 'btn_news.news.keyword',
                'required' => false,
                'attr' => array(
                    'placeholder' => 'btn_news.news.type_here',
                ),
            ))
            ->add('category', 'btn_news_category', array(
                'label' => 'btn_news.news.category',
                'class' => 'BtnNewsBundle:NewsCategory',
                'query_builder' => function (EntityRepository $em) {
                    return $em
                        ->createQueryBuilder('c')
                        ->join('Btn\NewsBundle\Entity\News', 'n', Join::WITH, 'n.category = c.id')
                        ->orderBy('c.title')
                        ;
                },
                'required' => false,
                'expanded' => false,
            ))
        ;
    }
}