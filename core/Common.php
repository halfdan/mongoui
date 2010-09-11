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

class Common {

    /**
     * Gets a variable from an request array. This function is borrowed
     * from Piwik (piwik.org) for now.
     * @license GPLv3
     *
     * @param string $varName The name of the request variable
     * @param string $varDefault The default if the variable was not in the request
     * @param string $varType The expected type of the value
     * @param array $requestArrayToUse GET/POST/REQUEST/..
     * @return $varType Either $varType or string
     */
    public static function getRequestVar($varName, $varDefault = null, $varType = null, $requestArrayToUse = null) {
        if (is_null($requestArrayToUse)) {
            $requestArrayToUse = $_GET + $_POST;
        }
        //$varDefault = self::sanitizeInputValues($varDefault);
        if ($varType == 'int') {
            // settype accepts only integer
            // 'int' is simply a shortcut for 'integer'
            $varType = 'integer';
        }

        // there is no value $varName in the REQUEST so we try to use the default value
        if (empty($varName)
                || !isset($requestArrayToUse[$varName])
                || (!is_array($requestArrayToUse[$varName])
                && strlen($requestArrayToUse[$varName]) === 0
                )
        ) {
            if (is_null($varDefault)) {
                throw new \Exception("The parameter '$varName' isn't set in the Request, and a default value wasn't provided.");
            } else {
                if (!is_null($varType)
                        && in_array($varType, array('string', 'integer', 'array'))
                ) {
                    settype($varDefault, $varType);
                }
                return $varDefault;
            }
        }

        // Normal case, there is a value available in REQUEST for the requested varName
        //$value = self::sanitizeInputValues($requestArrayToUse[$varName]);
        $value = $requestArrayToUse[$varName];

        if (!is_null($varType)) {
            $ok = false;

            if ($varType == 'string') {
                if (is_string($value))
                    $ok = true;
            }
            elseif ($varType == 'integer') {
                if ($value == (string) (int) $value)
                    $ok = true;
            }
            elseif ($varType == 'float') {
                if ($value == (string) (float) $value)
                    $ok = true;
            }
            elseif ($varType == 'array') {
                if (is_array($value))
                    $ok = true;
            }
            else {
                throw new \Exception("\$varType specified is not known. It should be one of the following: array, int, integer, float, string");
            }

            // The type is not correct
            if ($ok === false) {
                if ($varDefault === null) {
                    throw new \Exception("The parameter '$varName' doesn't have a correct type, and a default value wasn't provided.");
                }
                // we return the default value with the good type set
                else {
                    settype($varDefault, $varType);
                    return $varDefault;
                }
            }
        }
        return $value;
    }

    /**
     * Determines if the request has been sent via AJAX     *
     *
     * @return boolean
     */
    public static function isAjaxRequest() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH'])
        && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
    }

    /**
     * Fetches the name of the current theme.
     *
     * @return string The name of the current theme
     */
    public static function getCurrentTheme() {
        return "default";
    }

}

?>
