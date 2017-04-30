<?php

namespace Application\Service;

use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Trait permettant d'accéder à la couche service dans les helpers de vues
 */
trait ServiceLocatorHelperAwareTrait
{
    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator = null;

    /**
     * Set the service locator.
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return $this
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this -> serviceLocator = $serviceLocator;
        return $this;
    }

    /**
     * Get the service locator.
     *
     * @return \Zend\ServiceManager\ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        // Double appel pour accéder au bon service locator... zf2 power
        return $this -> serviceLocator -> getServiceLocator();
    }
}
