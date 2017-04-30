<?php

namespace Application\Service;



use Application\Utils\Utils;
use Zend\Cache\Storage\StorageInterface;
use Zend\I18n\Translator\Translator;
use Zend\Mvc\Router\Http\TreeRouteStack;

trait ServiceProviderTrait
{



    /**
     * @return BaseService
     */
    public function getBaseService()
    {
        return $this->getServiceLocator()->get('Application\Service\Base');
    }

    /**
     * @return StorageInterface
     */
    public function getCacheService()
    {
        return $this->getServiceLocator()->get('Application\Cache');
    }

    /**
     * @return TreeRouteStack
     */
    public function getRouterService()
    {
        return $this->getServiceLocator()->get('router');
    }

    /**
     * @return Translator
     */
    public function getTranslator()
    {
        return $this->getServiceLocator()->get('translator');
    }



    public function getConfigService()
    {
        return $this->getServiceLocator()->get('config');
    }

    public function getApplicationConfig()
    {
        return Utils::getValueWithDefault("application", $this->getConfigService(), array());
    }

    public function getImageConfig()
    {
        return Utils::getValueWithDefault("images", $this->getApplicationConfig(),array());
    }

    /**
     * Récupération du logger
     * Commentaire court mais inutile
     * @return \Zend\Log\Logger
     */
    public function getLogger()
    {
        /** @var \Zend\Log\Logger $logger */
        $logger = $this->getServiceLocator()->get('Application\Log');
        return $logger;
    }


}


