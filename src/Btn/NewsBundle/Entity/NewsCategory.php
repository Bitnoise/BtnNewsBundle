<?php

namespace Btn\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Btn\NewsBundle\Model\AbstractNewsCategory;

/**
 * @ORM\Table(name="btn_news_category", indexes={
 *     @ORM\Index(name="slug_idx", columns={"slug"}),
 *     @ORM\Index(name="visible_idx", columns={"visible", "position"})
 * })
 * @ORM\Entity(repositoryClass="Btn\NewsBundle\Repository\NewsCategoryRepository")
 */
class NewsCategory extends AbstractNewsCategory
{
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(
     *     targetEntity="Btn\NewsBundle\Entity\News",
     *     mappedBy="category",
     *     cascade={"persist", "remove"}
     * )
     */
    protected $news;
}
