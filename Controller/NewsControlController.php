<?php

namespace Btn\NewsBundle\Controller;

use Btn\AdminBundle\Controller\BaseCrudController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Btn\AdminBundle\Annotation\Crud;

/**
 * @Route("/news")
 * @Crud()
 */
class NewsControlController extends BaseCrudController
{
}
