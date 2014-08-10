<?php

namespace Btn\NewsBundle\Form\Type;

use Btn\AdminBundle\Form\Type\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class NewsCategoryType extends AbstractType
{
    /**
     *
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(array(
            'empty_value'   => 'btn_news.type.news_category.empty_value',
            'label'         => 'btn_news.type.news_category.label',
            'data_class'    => null,
            'class'         => $this->class,
            'query_builder' => function (EntityRepository $em) {
                return $em
                    ->createQueryBuilder('nc')
                    ->orderBy('nc.position', 'ASC');
            },
            'property' => 'title',
            'required' => false,
            'expanded' => false,
            'multiple' => false,
        ));
    }

    /**
     *
     */
    public function getParent()
    {
        return 'entity';
    }

    /**
     *
     */
    public function getName()
    {
        return 'btn_newscategory';
    }
}
