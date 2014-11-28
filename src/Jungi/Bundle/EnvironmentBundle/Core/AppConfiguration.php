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

/**
 * AppConfiguration
 *
 * @author Piotr Kugla <piku235@gmail.com>
 */
class AppConfiguration
{
    /**
     * @var array
     */
    protected $config;

    /**
     * Constructor
     *
     * @param array $config A configuration
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * Returns all configuration
     *
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Returns environments configuration
     *
     * @return array
     */
    public function getEnvironmentsConfig()
    {
        return $this->config['environments'];
    }

    /**
     * Returns an environment configuration
     *
     * @param string      $env An environment
     * @param string|null $key A key element to return from the config (optional)
     *
     * @return mixed
     *
     * @throws \RuntimeException
     */
    public function getEnvironmentConfig($env, $key = null)
    {
        if (!isset($this->config['environments'][$env])) {
            throw new \RuntimeException(sprintf('The given environment "%s" config is not exist.', $env));
        }

        $config = $this->config['environments'][$env];
        if (null !== $key) {
            return isset($config[$key]) ? $config[$key] : null;
        }

        return $config;
    }
}
