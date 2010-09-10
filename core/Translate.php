<?php

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
