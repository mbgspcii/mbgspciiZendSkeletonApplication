<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'locale' => 'fr_FR',
    'translation_file_patterns' => array(
        array(
            'type' => 'Application\I18n\Translator\Loader\Ini',
            'base_dir' => __DIR__ . '/../lang',
            'pattern' => '%s.ini',
            'text_domain' => 'default',
        ),

    ),
);
