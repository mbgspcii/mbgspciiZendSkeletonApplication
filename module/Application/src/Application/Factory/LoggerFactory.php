<?php

namespace Application\Factory;

use Zend\Log\Logger;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Logger.
 */
class LoggerFactory implements FactoryInterface
{
    protected $logfile = 'runtime/logs/application.log';

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        // Configure the logger
        $config = $serviceLocator->get('Config');
        $logLevel = isset($config['application']['log']['level']) ? $config['application']['log']['level'] : 4;
        $logConfig = array(
            'writers' => array(
                array(
                    'name' => 'stream',
                    'priority' => 1000,
                    'options' => array(
                        'stream' => $this->logfile,
                        'filters' => array(
                            array(
                                'name' => 'priority',
                                'options' => array(
                                    'priority' => $logLevel,
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        );

        // creation des dossiers nécessaires
        if (!is_dir('runtime/logs')) {
            mkdir('runtime/logs', 0770, true);
        }
        if (!file_exists($this->logfile)) {
            touch($this->logfile);
        }
        $logger = new Logger($logConfig);
        return $logger;
    }
}
