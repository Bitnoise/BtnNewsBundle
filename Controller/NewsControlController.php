<?php

namespace Btn\NewsBundle\Controller;

use Btn\AdminBundle\Controller\CrudController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Btn\AdminBundle\Annotation\Crud;

/**
 * @Route("/news")
 * @Crud()
 */
class NewsControlController extends CrudController
{
}
