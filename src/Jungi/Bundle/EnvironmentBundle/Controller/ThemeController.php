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

use Jungi\Bundle\EnvironmentBundle\Annotation\Environment;
use Jungi\Bundle\EnvironmentBundle\Theme\Tag as LocalTag;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * ThemeController.
 *
 * @Environment("default")
 */
class ThemeController extends Controller
{
    public function manageAction(Request $request)
    {
        $env = $this->get('jungi_environment.context')->getEnvironment();
        $themeHolder = $this->get('jungi_theme.holder');

        $currentTheme = $themeHolder->getTheme();
        $themes = $this->get('jungi_theme.source')->findThemesWithTags(array(
            new LocalTag\Environment($env),
        ));
        $form = $this->createFormBuilder(array(
                'theme' => $currentTheme,
            ))
            ->add('theme', 'choice', array(
                'choices' => $themes,
                'choice_label' => 'name',
                'choice_value' => 'name',
                'choices_as_values' => true,
            ))
            ->add('submit', 'submit')
            ->getForm();

        $form->handleRequest($request);
        if ($form->isValid()) {
            $data = $form->getData();
            $this->get('jungi_theme.changer')->change($data['theme'], $request);
            $currentTheme = $themeHolder->getTheme();
        }

        return $this->render('JungiEnvironmentBundle:Theme:manage.html.twig', array(
            'form' => $form->createView(),
            'theme' => $currentTheme,
            'environment' => $env,
        ));
    }
}
