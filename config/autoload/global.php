<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    'application' => array(
        'log' => array(
            'level' => 3,
        ),
    ),
    'asset_manager' => array(
        'caching' => array(
            'default' => array(
                'cache' => 'AssetManager\\Cache\\FilePathCache',
                'options' => array(
                    'dir' => 'public',
                ),
            ),
        ),
    ),
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host' => 'override in local',
                    'user' => 'override in local',
                    'password' => 'override in local',
                    'dbname' => 'zf2_skeleton',
                    'charset' => 'utf8',
                ),
            )
        ),
    ),
    'version' => '1.0.0',
);
