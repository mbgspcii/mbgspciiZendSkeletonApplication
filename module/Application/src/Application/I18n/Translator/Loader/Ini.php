<?php

namespace Application\I18n\Translator\Loader;

use Zend\Config\Reader\Ini as IniReader;
use Zend\I18n\Exception;
use Zend\I18n\Translator\Loader\FileLoaderInterface;
use Zend\I18n\Translator\Plural\Rule as PluralRule;
use Zend\I18n\Translator\TextDomain;

/**
 * PHP INI format loader.
 */
class Ini implements FileLoaderInterface
{
    /**
     * load(): defined by FileLoaderInterface.
     *
     * @see    FileLoaderInterface::load()
     * @param  string $locale
     * @param  string $filename
     * @return TextDomain|null
     * @throws Exception\InvalidArgumentException
     */
    public function load($locale, $filename)
    {
        if (!is_file($filename) || !is_readable($filename)) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Could not open file %s for reading',
                $filename
            ));
        }

        $messages           = array();
        $iniReader          = new IniReader();
        $iniReader->setNestSeparator(null);
        $messagesNamespaced = $iniReader->fromFile($filename);

        $list = $messagesNamespaced;
        if (isset($messagesNamespaced['translation'])) {
           $list = $messagesNamespaced['translation'];
        }

        foreach ($list as $message => $translation) {
            $messages[$message] = $translation;
        }

        if (!is_array($messages)) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Expected an array, but received %s',
                gettype($messages)
            ));
        }

        $textDomain = new TextDomain($messages);

        if (array_key_exists('plural', $messagesNamespaced)
            && isset($messagesNamespaced['plural']['plural_forms'])
        ) {
            $textDomain->setPluralRule(
                PluralRule::fromString($messagesNamespaced['plural']['plural_forms'])
            );
        }

        return $textDomain;
    }
}
