<?php
/*
 * This file is part of the JungiEnvironmentBundle package.
 *
 * (c) Piotr Kugla <piku235@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jungi\Bundle\EnvironmentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Jungi\Bundle\EnvironmentBundle\Annotation\Environment;

/**
 * DefaultController
 *
 * @Environment("default")
 */
class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('JungiEnvironmentBundle:Default:index.html.twig');
    }
}
