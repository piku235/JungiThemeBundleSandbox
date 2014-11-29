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
 * AdminController
 *
 * @Environment("admin")
 */
class AdminController extends Controller
{
    public function indexAction()
    {
        $themes = $this->get('jungi_theme.manager')->getThemes();

        return $this->render('JungiEnvironmentBundle:Admin:index.html.twig', array(
            'themes' => $themes
        ));
    }
}
