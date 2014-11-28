<?php
/*
 * This file is part of the JungiEnvironmentBundle package.
 *
 * (c) Piotr Kugla <piku235@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jungi\Bundle\EnvironmentBundle\Core;

use Jungi\Bundle\ThemeBundle\Core\ThemeHolderInterface;
use Jungi\Bundle\ThemeBundle\Core\ThemeInterface;

/**
 * AppContext
 *
 * @author Piotr Kugla <piku235@gmail.com>
 */
class AppContext implements ThemeHolderInterface
{
    /**
     * @var string
     */
    protected $env;

    /**
     * @var ThemeInterface
     */
    protected $theme;

    /**
     * @var AppConfiguration
     */
    protected $config;

    /**
     * Constructor
     *
     * @param AppConfiguration $config An app configuration
     */
    public function __construct(AppConfiguration $config)
    {
        $this->config = $config;
    }

    /**
     * {@inheritdoc}
     */
    public function setTheme(ThemeInterface $theme)
    {
        $this->theme = $theme;
    }

    /**
     * {@inheritdoc}
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Returns the current theme name based on the current environment
     *
     * @return string
     */
    public function getThemeName()
    {
        return $this->config->getEnvironmentConfig($this->env, 'theme');
    }

    /**
     * Sets the current environment
     *
     * @param string $env An environment
     *
     * @return void
     */
    public function setEnvironment($env)
    {
        $this->env = $env;
    }

    /**
     * Returns the current environment
     *
     * @return string
     */
    public function getEnvironment()
    {
        return $this->env;
    }

    /**
     * Returns the current environment configuration
     *
     * @param string|null $key A key element to return from the config (optional)
     *
     * @return mixed
     */
    public function getEnvironmentConfig($key = null)
    {
        return $this->config->getEnvironmentConfig($this->env, $key);
    }
}
