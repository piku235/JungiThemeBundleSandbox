<?php
/*
 * This file is part of the JungiEnvironmentBundle package.
 *
 * (c) Piotr Kugla <piku235@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jungi\Bundle\EnvironmentBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Doctrine\Common\Annotations\Reader as AnnotationReader;
use Doctrine\Common\Util\ClassUtils;
use Jungi\Bundle\EnvironmentBundle\Core\AppContext;

/**
 * ControllerListener
 *
 * @author Piotr Kugla <piku235@gmail.com>
 */
class ControllerListener implements EventSubscriberInterface
{
    /**
     * @var AnnotationReader
     */
    protected $reader;

    /**
     * @var AppContext
     */
    protected $appContext;

    /**
     * Constructor
     *
     * @param AnnotationReader $reader An annotation reader
     */
    public function __construct(AppContext $context, AnnotationReader $reader)
    {
        $this->reader = $reader;
        $this->appContext = $context;
    }

    /**
     * Read environment annotation in controller
     *
     * @param FilterControllerEvent $event An event
     *
     * @return void
     *
     * @throws \RuntimeException
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        list($controller) = $event->getController();

        $className = ClassUtils::getClass($controller);
        $reflection = new \ReflectionClass($className);
        if ($reflection->getNamespaceName() != 'Jungi\Bundle\EnvironmentBundle\Controller') {
            return;
        }

        $environment = $this->reader->getClassAnnotation($reflection, '\Jungi\Bundle\EnvironmentBundle\Annotation\Environment');
        if (null === $environment) {
            throw new \RuntimeException(sprintf('The controller "%s" has missing annotation "Environment".', $className));
        }

        $this->appContext->setEnvironment($environment->value);
    }

    /**
     * (non-PHPdoc)
     * @see \Symfony\Component\EventDispatcher\EventSubscriberInterface::getSubscribedEvents()
     */
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::CONTROLLER => array('onKernelController'),
        );
    }
}
