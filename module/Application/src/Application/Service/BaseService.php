<?php
namespace Application\Service;


use Application\Utils\Utils;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\Session\Container;

/**
 * Class BaseService
 * @package Application\Service
 */
class BaseService implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    use ServiceProviderTrait;

    /**
     * Pour récupérer la config
     * @return array|object
     */
    protected function getConfig()
    {
        $appConfig = $this->getConfigService();

        return $appConfig;
    }

    /**
     * Récupération du paramétrage de debug
     * @return array|object
     */
    protected function getDebug()
    {
        $debug = Utils::getValueWithDefault('debug', $this->getConfig(), null);
        return $debug;
    }


    /**
     * Cast an object to another class, keeping the properties, but changing the methods
     *
     * @param string $class Class name
     * @param object $object
     * @return object
     */
    protected function castToClass($class, $object)
    {
        return unserialize(preg_replace('/^O:\d+:"[^"]++"/', 'O:' . strlen($class) . ':"' . $class . '"', serialize($object)));
    }


    /**
     * Récupération du container qui permet de stocker le modèle de l'application en session
     * @return Container
     */
    protected function getEtatEtapesContainer()
    {
        /** @var Container $modelContainer */
        $modelContainer = new Container('etatEtape');
        return $modelContainer;
    }


    public function testLogger()
    {
        $this->getLogger()->debug('Test Logger', $this->getLoggerArray());
    }


    /**
     * @param bool $debug
     */
    protected function setDebug($debug = false)
    {
        $debugContainer = $this->getDebugContainer();
        $debugContainer->debug = $debug;
    }

    protected function getLoggerArray()
    {
        return array(
            'class' => __CLASS__,
            'ligne' => __LINE__,
            'methode' => __METHOD__
        );
    }

    /**
     * Stockage en session du mode debug ou pas
     * @return Container
     */
    protected function getDebugContainer()
    {
        /** @var Container $evenementContainer */
        $debugContainer = new Container('debugContainer');
        return $debugContainer;
    }

    /**
     * @return null
     */
    protected function getTmdbConfig()
    {
        $tmdbCpnfig = Utils::getValueWithDefault('tmbd', $this->getConfig());

        $this->getLogger()->debug("getTmdbConfig", $tmdbCpnfig);

        return $tmdbCpnfig;
    }
}
