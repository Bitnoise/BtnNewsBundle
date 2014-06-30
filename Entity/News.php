<?php

namespace Btn\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Btn\NewsBundle\Entity\News
 *
 * @ORM\Table(name="news")
 * @ORM\Entity(repositoryClass="Btn\NewsBundle\Repository\NewsRepository")
 */
class News
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $slug
     *
     * @ORM\Column(name="slug", type="string", length=255)
     * @Assert\Regex(pattern="/^[_\-a-z0-9]+$/", message="Slug contains only digits, small letters and chars like '-', '_'")
     * @Assert\NotBlank()
     */
    private $slug;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @var text $preview
     *
     * @ORM\Column(name="preview", type="text", nullable=true)
     */
    private $preview;

    /**
     * @var text $text
     *
     * @ORM\Column(name="text", type="text", nullable=true)
     */
    private $text;

     /**
     * @ORM\ManyToOne(targetEntity="Btn\NewsBundle\Entity\NewsCategory", inversedBy="news")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $category;

    /**
     * @var datetime $created_at
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Assert\NotBlank()
     */
    private $created_at;


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
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
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
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
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
     * Set preview
     *
     * @param text $preview
     */
    public function setPreview($preview)
    {
        $this->preview = $preview;
    }

    /**
     * Get preview
     *
     * @return text
     */
    public function getPreview()
    {
        return $this->preview;
    }

    /**
     * Set text
     *
     * @param text $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * Get text
     *
     * @return text
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set created_at
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }

    /**
     * Get created_at
     *
     * @return datetime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set category
     *
     * @param  \Btn\NewsBundle\Entity\NewsCategory $category
     * @return News
     */
    public function setCategory(\Btn\NewsBundle\Entity\NewsCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Btn\NewsBundle\Entity\NewsCategory
     */
    public function getCategory()
    {
        return $this->category;
    }
}
