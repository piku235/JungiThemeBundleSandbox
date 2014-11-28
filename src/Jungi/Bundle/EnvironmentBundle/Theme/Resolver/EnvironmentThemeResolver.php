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
 * EnvironmentThemeResolver is a kind of adapter for a AppContext instance
 *
 * AppContext has whole knowledge about the current environment and the theme for this environment
 *
 * @author Piotr Kugla <piku235@gmail.com>
 */
class EnvironmentThemeResolver implements ThemeResolverInterface
{
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
     * (non-PHPdoc)
     * @see \Jungi\Bundle\ThemeBundle\Resolver\ThemeResolverInterface::resolveThemeName()
     */
    public function resolveThemeName(Request $request)
    {
        // If the app context does not have environment for the current request, ignore
        if (null === $this->appContext->getEnvironment()) {
            return null;
        }

        return $this->appContext->getThemeName();
    }

    /**
     * (non-PHPdoc)
     * @see \Jungi\Bundle\ThemeBundle\Resolver\ThemeResolverInterface::setThemeName()
     */
    public function setThemeName($themeName, Request $request)
    {
        throw new \BadMethodCallException('This method is not supported. Of course you can define own logic for this action.');
    }
}
