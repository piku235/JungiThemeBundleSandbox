<?php

namespace Jungi\Bundle\BootstrapThemeBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * JungiBootstrapThemeBundle.
 *
 * @author Piotr Kugla <piku235@gmail.com>
 */
class JungiBootstrapThemeBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $builder)
    {
        /* @var \Jungi\Bundle\ThemeBundle\DependencyInjection\JungiThemeExtension $ext */

        $ext = $builder->getExtension('jungi_theme');
        $ext->registerMappingFile(__DIR__.'/Resources/config/theme.xml');
    }
}
