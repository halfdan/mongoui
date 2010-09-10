<?php

namespace MongoUI\Core;

class FrontController {

    protected static $instance = null;

    /**
     * @return MongoUI\Core\FrontController
     */
    static public function getInstance() {
        if (self::$instance == null) {
            $c = __CLASS__;
            self::$instance = new $c();
        }
        return self::$instance;
    }

    public function init() {
        $translation = Translate::getInstance();
        
    }

}
