<?php

namespace MongoUI\Core;

require_once 'PHPUnit/Framework.php';

require_once dirname(__FILE__) . '/../../core/Common.php';
require_once dirname(__FILE__) . '/../../core/Translate.php';

/**
 * Test class for MongoUI\Core\Translate.
 */
class TranslateTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Translate
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = Translate::getInstance();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {

    }

    /**
     * @todo Implement testGetInstance().
     */
    public function testGetInstance() {
        $instance = Translate::getInstance();
        // Check if getInstance() returns correct object.
        $this->assertTrue(is_a($instance, 'MongoUI\Core\Translate'));
    }

    /**
     * @todo Implement testLoadLanguage().
     */
    public function testLoadLanguage() {
    }

    /**
     * @todo Implement testGetTranslation().
     */
    public function testGetTranslation() {
    }

    /**
     * @todo Implement testGetLanguageToLoad().
     */
    public function testGetLanguageToLoad() {
        // Without any parameter given en_US should be the default language
        $this->assertEquals(Translate::DEFAULT_LANG, $this->object->getLanguageToLoad());

        // Set language to german
        $_GET['lang'] = 'de_DE';
        $this->assertEquals('de_DE', $this->object->getLanguageToLoad());

        // Set non-existing language
        $_GET['lang'] = 'xx_XX';
        $this->setExpectedException("\Exception");
        $this->object->getLanguageToLoad();
    }

    /**
     * @todo Implement testGetAvailableLanguages().
     */
    public function testGetAvailableLanguages() {
        // Fetch list
        $languages = $this->object->getAvailableLanguages();
        $this->assertNotNull($languages);

        // Returns the same twice and more times
        $languagesCached = $this->object->getAvailableLanguages();
        $this->assertEquals($languages, $languagesCached);

        // Check for some languages
        $keys = array('de_DE', 'en_US');

        // Create anonymous function to check for $key in $array
        $arrayContains = function(array $array, $key) {
            foreach($array as $entry) {
                if($entry[0] == $key)
                    return true;
            }
            return false;
        };

        // For each key do an assert.
        foreach($keys as $key) {
            $this->assertTrue($arrayContains($languages, $key));
        }
    }

    /**
     * @todo Implement testIsValidLanguage().
     */
    public function testIsValidLanguage() {
        // Testing for german (de_DE) translation
        $this->assertTrue($this->object->isValidLanguage('de_DE'));
        // Checking result for invalid language
        $this->assertFalse($this->object->isValidLanguage('xx_XX'));
    }

}

?>
