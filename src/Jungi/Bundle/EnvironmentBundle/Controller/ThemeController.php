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

use Jungi\Bundle\EnvironmentBundle\Theme\Tag as LocalTag;
use Jungi\Bundle\ThemeBundle\Tag as GlobalTag;
use Jungi\Bundle\EnvironmentBundle\Annotation\Environment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\ChoiceList\ObjectChoiceList;
use Symfony\Component\HttpFoundation\Request;

/**
 * ThemeController
 *
 * @Environment("default")
 */
class ThemeController extends Controller
{
    public function manageAction(Request $request)
    {
        $env = $this->get('jungi_environment.context')->getEnvironment();
        $themes = $this->get('jungi_theme.registry')->findThemesWithTags(array(
            new LocalTag\Environment($env)
        ));
        $currentTheme = $this->get('jungi_theme.holder')->getTheme();
        $data = array(
            'theme' => $currentTheme
        );
        $form = $this->createFormBuilder($data)
            ->add('theme', 'choice', array(
                'choice_list' => new ObjectChoiceList($themes, 'name', array(), null, 'name')
            ))
            ->add('submit', 'submit')
            ->getForm();

        $form->handleRequest($request);
        if ($form->isValid()) {
            $data = $form->getData();
            $this->get('jungi_theme.changer')->change($data['theme'], $request);
        }

        return $this->render('JungiEnvironmentBundle:Theme:manage.html.twig', array(
            'form' => $form->createView(),
            'theme' => $currentTheme,
            'environment' => $env,
        ));
    }
}
