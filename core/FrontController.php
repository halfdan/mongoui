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
        // Initializing the language
        $translation = Translate::getInstance();

        // If requested with ?lang=<lang> we load the language.
        $lang = $translation->getLanguageToLoad();
        $translation->loadLanguage($lang);
    }

    public function dispatch($module = null, $action = null, $parameters = null) {
        if (is_null($module)) {
            $defaultModule = 'Login';
            $module = Common::getRequestVar('module', $defaultModule, 'string');
        }

        if (is_null($action)) {
            $action = Common::getRequestVar('action', false);
        }

        if (is_null($parameters)) {
            $parameters = array();
        }

        $class = "\\MongoUI\\Modules\\" . $module;
        if(class_exists($class, true)) {
            $controller = new $class();
        } else {
            throw new \Exception("Module controller $module not found!");
        }

        if ($action === false) {
            $action = $controller->getDefaultAction();
        }

        if (!is_callable(array($controller, $action))) {
            throw new \Exception("Action $action not found in the module $module.");
        }

        return call_user_func_array(array($controller, $action), $parameters);
    }
}
