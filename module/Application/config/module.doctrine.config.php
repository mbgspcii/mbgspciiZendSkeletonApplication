<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Application;
return array(
    'driver' => array(
        'app_driver' => array(
            'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
            'cache' => 'array',
            'paths' => array(
                __DIR__ . '/../src/' . __NAMESPACE__ . '/Model'
            )
        ),
        'orm_default' => array(
            'drivers' => array(
                __NAMESPACE__ . '\Model' => 'app_driver'
            )
        ),
    ),

    'service_manager' => array(
        'use_defaults' => true,
        'aliases' => array(
            'orm_em' => 'doctrine.entitymanager.orm_default'
        ),
    ),

    'configuration' => array(
        'orm_default' => array(
            'generate_proxies' => true,
            'proxy_dir' => 'runtime/cache/DoctrineORMModule/Proxy',
            'proxy_namespace' => 'DoctrineORMModule\Proxy',
        )
    ),
);