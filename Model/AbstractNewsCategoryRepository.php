<?php

namespace Btn\NewsBundle\Model;

use Doctrine\ORM\EntityRepository;

/**
 *
 */
abstract class AbstractNewsCategoryRepository extends EntityRepository
{
    public function getSearchQuery($conditions)
    {
        $qb = $this->createQueryBuilder('nc')
            ->select('nc')
        ;
        if (!empty($conditions) && is_array($conditions)) {
            $expr = call_user_func_array(array($qb->expr(), 'andx'), $conditions);
            $qb->where($expr);
        }

        return $qb;
    }

    /**
     * @return \Btn\NewsBundle\NewsCategory[]
     */
    public function findAllVisible()
    {
        $query = $this
            ->createQueryBuilder('nc')
            ->andWhere('nc.visible = :visible')
            ->orderBy('nc.position', 'ASC')
            ->setParameter(':visible', 1)
            ->getQuery()
        ;

        return $query->getResult();
    }
}
