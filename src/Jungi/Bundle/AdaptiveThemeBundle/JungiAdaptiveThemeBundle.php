<?php

namespace Jungi\Bundle\AdaptiveThemeBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * JungiAdaptiveThemeBundle
 *
 * @author Piotr Kugla <piku235@gmail.com>
 */
class JungiAdaptiveThemeBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $loader = $this->container->get('jungi_theme.mapping.loader.xml');
        $loader->load(__DIR__.'/Resources/config/theme.xml');
    }
}
