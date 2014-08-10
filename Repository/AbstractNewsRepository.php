<?php

namespace Btn\NewsBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Btn\NewsBundle\Entity\News;
use Btn\NewsBundle\Entity\NewsCategoryInterface;

/**
 *
 */
abstract class AbstractNewsRepository extends EntityRepository
{
    /**
     *
     */
    public function getBaseQueryBuilder()
    {
        return $this->createQueryBuilder('n')->orderBy('n.created_at', 'DESC');
    }

    /**
     *
     */
    public function getNewsForCategoryQueryBuilder(NewsCategoryInterface $category = null)
    {
        $qb = $this->getBaseQueryBuilder();

        if ($category) {
            $qb->where('n.category = :category')->setParameter(':category', $category);
        }

        return $qb;
    }

    /**
     * Get array of last news
     *
     * @param  integer $count
     * @return array
     */
    public function getLastNews($count = null, NewsCategoryInterface $category = null)
    {
        $qb = $this->getBaseQueryBuilder();

        if ($category) {
            $qb->where('n.category = :category')->setParameter(':category', $category);
        }

        $query = $qb->getQuery();

        $count = (int) $count;
        if ($count) {
            $query->setMaxResults($count);
        }

        return $query->getResult();
    }

    /**
     *
     */
    public function getMonthsWithYears(NewsCategoryInterface $category = null)
    {
        $qb = $this->getBaseQueryBuilder()
            ->select('SUBSTRING(n.created_at, 6, 2) as month, SUBSTRING(n.created_at, 1, 4) as year')
            ->groupBy('year, month')
        ;

        if (null != $category) {
            $qb->addWhere('n.category = :category')->setParameter(':category', $category);
        }

        $q = $qb->getQuery();

        return $q->getResult();
    }

    /**
     *
     */
    public function getNewsFromYearMonthQueryBuilder($year, $month, NewsCategoryInterface $category = null)
    {
        $qb = $this->getBaseQueryBuilder()
            ->where('n.created_at LIKE :date')->setParameter(':date', $year . '-' . $month . '%')
        ;

        if (null != $category) {
            $qb->addWhere('n.category = :category')->setParameter(':category', $category);
        }

        return $qb;
    }

    /**
     *
     */
    public function getPrevNews(NewsInterface $news, NewsCategoryInterface $category = null)
    {
        $qb = $this->createQueryBuilder('n')
            ->where('n.created_at < :created_at')->setParameter(':created_at', $news->getCreatedAt())
            ->orderBy('n.created_at', 'DESC')
        ;

        return $qb->getQuery()->setMaxResults(1)->getOneOrNullResult();
    }

    /**
     *
     */
    public function getNextNews(NewsInterface $news, NewsCategoryInterface $category = null)
    {
        $qb = $this->createQueryBuilder('n')
            ->where('n.created_at > :created_at')->setParameter(':created_at', $news->getCreatedAt())
            ->orderBy('n.created_at', 'ASC')
        ;

        return $qb->getQuery()->setMaxResults(1)->getOneOrNullResult();
    }
}
