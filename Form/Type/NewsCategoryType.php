<?php

namespace Btn\NewsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class NewsCategoryType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(array(
            'empty_value'   => 'btn_newsbundle.type.news_category.empty_value',
            'label'         => 'btn_newsbundle.type.news_category.label',
            'empty_value'   => 'footer.choose_news_category',
            'label'         => 'footer.choose_news_category',
            'class'         => 'BtnNewsBundle:NewsCategory',
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

    public function getParent()
    {
        return 'entity';
    }

    public function getName()
    {
        return 'btn_newsbundlebundle_news_category';
    }
}
