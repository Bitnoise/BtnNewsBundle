<?php

namespace Btn\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Btn\BaseBundle\Util\Text;

/**
 * @ORM\MappedSuperclass()
 */
abstract class AbstractNewsCategory implements NewsCategoryInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=64, nullable=false)
     * @Assert\NotBlank()
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=64, nullable=false)
     * @Assert\Regex(pattern="/^[_\-a-z0-9]+$/")
     * @Assert\NotBlank(message="Slug contains only digits, small letters and chars like '-', '_'")
     */
    protected $slug;

    /**
     * @var boolean
     *
     * @ORM\Column(name="visible", type="boolean", nullable=false)
     */
    protected $visible = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="smallint", nullable=false)
     * @Assert\NotBlank(message="Position should be a number")
     */
    protected $position;

    /**
     *
     */
    public function __construct()
    {
        $this->news  = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param  string       $title
     * @return newsCategory
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param  string       $slug
     * @return newsCategory
     */
    public function setSlug($slug)
    {
        $this->slug = Text::slugify($slug);

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set visible
     *
     * @param  boolean      $visible
     * @return newsCategory
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * Get visible
     *
     * @return boolean
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * Set position
     *
     * @param  integer      $position
     * @return newsCategory
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Add news
     *
     * @param  \Btn\NewsBundle\Entity\News $news
     * @return newsCategory
     */
    public function addNews(\Btn\NewsBundle\Entity\News $news)
    {
        $this->newss[] = $newss;

        return $this;
    }

    /**
     * Remove news
     *
     * @param \Btn\NewsBundle\Entity\News $news
     */
    public function removeNews(\Btn\NewsBundle\Entity\News $news)
    {
        $this->newss->removeElement($newss);
    }

    /**
     * Get news
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNews()
    {
        return $this->newss;
    }

    /**
     *
     */
    public function __toString()
    {
        return $this->getTitle();
    }
}
