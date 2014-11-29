<?php
/*
 * This file is part of the JungiEnvironmentBundle package.
 *
 * (c) Piotr Kugla <piku235@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jungi\Bundle\EnvironmentBundle\Theme\Resolver;

use Jungi\Bundle\ThemeBundle\Resolver\ThemeResolverInterface;
use Jungi\Bundle\EnvironmentBundle\Core\AppContext;
use Symfony\Component\HttpFoundation\Request;

/**
 * EnvironmentThemeResolver uses php sessions for resolving and changing the current theme
 * for the actual environment.
 *
 * @author Piotr Kugla <piku235@gmail.com>
 */
class EnvironmentThemeResolver implements ThemeResolverInterface
{
    /**
     * @var string
     */
    const SESSION_NAME = 'jungi_environment_theme';

    /**
     * @var AppContext
     */
    protected $appContext;

    /**
     * Constructor
     *
     * @param AppContext $appContext An app context
     */
    public function __construct(AppContext $appContext)
    {
        $this->appContext = $appContext;
    }

    /**
     * {@inheritdoc}
     */
    public function resolveThemeName(Request $request)
    {
        $env = $this->appContext->getEnvironment();
        if (!$request->hasSession() || null === $env) {
            return null;
        }

        $themeName = $this->appContext->getThemeName();
        if ($themeNames = $request->getSession()->get(self::SESSION_NAME)) {
            if (!isset($themeNames[$env])) {
                $themeNames[$env] = $themeName;
                $request->getSession()->set(self::SESSION_NAME, $themeNames);
            } else {
                $themeName = $themeNames[$env];
            }
        } else {
            $request->getSession()->set(self::SESSION_NAME, array(
                $env => $themeName
            ));
        }

        return $themeName;
    }

    /**
     * {@inheritdoc}
     */
    public function setThemeName($themeName, Request $request)
    {
        if (null === $env = $this->appContext->getEnvironment()) {
            throw new \RuntimeException('The current theme cannot be changed due to missing environment.');
        } elseif (!$request->hasSession()) {
            throw new \RuntimeException('The session is required to change the current theme.');
        }

        $themeNames = array();
        if ($request->getSession()->has(self::SESSION_NAME)) {
            $themeNames = $request->getSession()->get(self::SESSION_NAME);
        }

        $themeNames[$env] = $themeName;
        $request->getSession()->set(self::SESSION_NAME, $themeNames);
    }
}
