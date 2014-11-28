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
        // If the app context does not have environment for the current request, ignore
        if (null === $env = $this->appContext->getEnvironment()) {
            return null;
        }

        $sessionName = self::SESSION_NAME . '.' . $env;
        if (!$request->hasSession() || !$request->getSession()->has($sessionName)) {
            return $this->appContext->getThemeName();
        }

        return $request->getSession()->get($sessionName);
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

        $request->getSession()->set(self::SESSION_NAME . '.' . $env, $themeName);
    }
}
