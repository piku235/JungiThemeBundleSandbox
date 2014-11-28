<?php
namespace Jungi\Bundle\BootstrapThemeBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * JungiBootstrapThemeBundle
 *
 * @author Piotr Kugla <piku235@gmail.com>
 */
class JungiBootstrapThemeBundle extends Bundle
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
