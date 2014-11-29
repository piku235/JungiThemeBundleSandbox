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

use Jungi\Bundle\ThemeBundle\Core\ThemeInterface;
use Jungi\Bundle\EnvironmentBundle\Theme\Tag\Environment as EnvironmentTag;
use Jungi\Bundle\EnvironmentBundle\Annotation\Environment;
use Symfony\Component\Form\Extension\Core\ChoiceList\ObjectChoiceList;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
        $currentTheme = $this->get('jungi_theme.holder')->getTheme();
        $data = array(
            'theme' => $currentTheme->getName()
        );
        $filter = function(ThemeInterface $theme) use ($env, $currentTheme) {
            return $currentTheme !== $theme && $theme->getTags()->contains(new EnvironmentTag($env));
        };
        $themes = array_filter($this->get('jungi_theme.manager')->getThemes(), $filter);
        $form = $this->createFormBuilder($data)
            ->add('theme', 'choice', array(
                'choice_list' => new ObjectChoiceList($themes, 'information.name', array(), null, 'name'),
                'empty_value' => 'Choose a theme'
            ))
            ->add('submit', 'submit')
            ->getForm();

        $form->handleRequest($request);
        if ($form->isValid()) {
            $data = $form->getData();
            $currentTheme = $data['theme'];
            $this->get('jungi_theme.changer')->change($currentTheme, $request);
        }

        return $this->render('JungiEnvironmentBundle:Theme:manage.html.twig', array(
            'form' => $form->createView(),
            'theme' => $currentTheme,
            'environment' => $env
        ));
    }
} 