<?php

namespace Btn\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="btn_news", indexes={
 *     @ORM\Index(name="slug_idx", columns={"slug"}),
 * })
 * @ORM\Entity(repositoryClass="Btn\NewsBundle\Repository\NewsRepository")
 */
class News extends AbstractNews
{
}
