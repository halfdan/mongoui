<?php
/**
 * Copyright (C) 2010  Fabian Becker
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace MongoUI\Core;

class Translate {
    const DEFAULT_LANG = "en_US";
    private static $instance = null;
    private $translations = array();

    private function __construct() {
        $this->loadDefaultLanguage();
    }

    /**
     * @return MongoUI_Translate
     */
    static public function getInstance() {
        if (self::$instance == null) {
            $c = __CLASS__;
            self::$instance = new $c();
        }
        return self::$instance;
    }

    public function loadLanguage($language) {
        // Default language is already loaded.
        if(self::DEFAULT_LANG == $language)
            return;
        $translation = $this->loadLanguageFromXML($language);
        $this->mergeTranslationArray($translation);
        $this->setLocale();
    }

    protected function loadDefaultLanguage() {
        $this->translations = $this->loadLanguageFromXML(self::DEFAULT_LANG);
    }

    /**
     * Returns translated string or given message if translation is not found.
     *
     * @param string Translation string index
     * @param array $args sprintf arguments
     * @return string
     */
    public function getTranslation($string, $args = array()) {
        if (!is_array($args)) {
            $args = array($args);
        }
        if (isset($this->translations[$string])) {
            $string = $this->translations[$string];
        }
        if (count($args) == 0) {
            return $string;
        }
        return vsprintf($string, $args);
    }

    /**
     * @return string the language filename prefix, eg 'en_US' for english
     * @throws exception if the language set is not a valid filename
     */
    public function getLanguageToLoad() {
        static $language = null;
        if (!is_null($language)) {
            return $language;
        }

        $language = \MongoUI\Core\Common::getRequestVar('lang', is_null($language) ? '' : $language, 'string');
        if (empty($language)) {
            $language = self::DEFAULT_LANG;
        }
        if ($this->isValidLanguage($language)) {
            return $language;
        } else {
            throw new \Exception("The language selected ('$language') is not a valid language file ");
        }
    }

    /**
     * Returns whether a language exists.
     *
     * @return boolean if the language exists or not
     * @param string $code
     */
    public function isValidLanguage($code) {
        $file = MONGOUI_ROOT . '/lang/' . $code . '.xml';
        return is_readable($file);
    }

    private function loadLanguageFromXML($language) {
        $path = MONGOUI_ROOT . '/lang/' . $language . '.xml';

        if (!file_exists($path)) {
            throw new \InvalidArgumentException("Language file for language {$language} does not exists!");
        }

        $xml = new \SimpleXMLElement($path, NULL, TRUE);
        $translations = array();
        foreach ($xml->children() as $label) {
            $index = (string) $label['index'];
            $translations[$index] = (string) $label;
        }
        return $translations;
    }

    private function mergeTranslationArray($translation) {
        // Merges a new translation into the existing translation array.
        // Using array_filter to filter out empty elements.
        $this->translations = array_merge($this->translations, array_filter($translation, 'strlen'));
    }

    /**
     * Set locale
     *
     * @see http://php.net/setlocale
     */
    private function setLocale() {
        $locale = $this->translations['General.Language.Locale'];
        $locale_variant = str_replace('UTF-8', 'UTF8', $locale);
        setlocale(LC_ALL, $locale, $locale_variant);
        setlocale(LC_CTYPE, '');
    }

}
