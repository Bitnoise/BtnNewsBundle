<?php

namespace Btn\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Btn\NewsBundle\Model\AbstractNews;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="btn_news", indexes={
 *     @ORM\Index(name="slug_idx", columns={"slug"}),
 *     @ORM\Index(name="created_at_idx", columns={"created_at"}),
 * })
 * @ORM\Entity(repositoryClass="Btn\NewsBundle\Repository\NewsRepository")
 */
class News extends AbstractNews
{
    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Btn\NewsBundle\Entity\NewsCategory", inversedBy="news")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $category;
}
