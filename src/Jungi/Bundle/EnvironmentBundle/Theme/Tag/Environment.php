<?php
/*
 * This file is part of the JungiEnvironmentBundle package.
 *
 * (c) Piotr Kugla <piku235@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jungi\Bundle\EnvironmentBundle\Theme\Tag;

use Jungi\Bundle\ThemeBundle\Tag\TagInterface;

/**
 * Environment tag allows to group themes by environment
 *
 * @author Piotr Kugla <piku235@gmail.com>
 */
class Environment implements TagInterface
{
    /**
     * @var string
     */
    protected $env;

    /**
     * Constructor
     *
     * @param string $env An environment
     */
    public function __construct($env)
    {
        $this->env = $env;
    }

    /**
     * Returns the environment
     *
     * @return string
     */
    public function getEnvironment()
    {
        return $this->env;
    }

    /**
     * (non-PHPdoc)
     * @see \Jungi\Bundle\ThemeBundle\Tag\TagInterface::isEqual()
     */
    public function isEqual(TagInterface $tag)
    {
        return $this == $tag;
    }

    /**
     * (non-PHPdoc)
     * @see \Jungi\Bundle\ThemeBundle\Tag\TagInterface::getName()
     */
    public static function getName()
    {
        return 'jungi.environment';
    }
}
