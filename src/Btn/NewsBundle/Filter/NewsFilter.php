<?php

namespace Btn\NewsBundle\Filter;

use Btn\BaseBundle\Filter\AbstractFilter;

class NewsFilter extends AbstractFilter
{
    public function applyFilters()
    {
        $qb = $this->getQueryBuilder();

        if (($keyword = $this->getValue('keyword'))) {
            $qb->andWhere('n.title LIKE :keyword')->setParameter(':keyword', '%'.$keyword.'%');
        }

        if (($category = $this->getValue('category'))) {
            $qb->andWhere('n.category = :category')->setParameter(':category', $category);
        }
    }
}