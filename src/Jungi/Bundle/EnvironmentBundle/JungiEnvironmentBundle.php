<?php

/*
 * This file is part of the JungiEnvironmentBundle package.
 *
 * (c) Piotr Kugla <piku235@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jungi\Bundle\EnvironmentBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class JungiEnvironmentBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $ext = $container->getExtension('jungi_theme');
        $ext->registerTag('Jungi\Bundle\EnvironmentBundle\Theme\Tag\Environment');
    }
}
