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

class Config implements \Countable {

    protected $configArray = array();
    protected $configOriginal = array();
    const DEFAULT_CONFIG = "config.ini.php";

    public function __construct($file = self::DEFAULT_CONFIG) {
        $this->loadConfig($file);
    }

    public function __get($name) {
        return $this->configArray->$name;
    }

    public function loadConfig($path) {
        if (!is_readable($path)) {
            throw new \Exception("Can't load config from {$path}.");
        }

        // Load ini file and process sections
        $ini = parse_ini_file($path, TRUE);
        if ($ini == FALSE) {
            throw new \Exception("Error in config file: {$path}.");
        }

        // We merge the new config into a possibly loaded one
        $this->configOriginal = array_merge($this->configArray, $ini);

        $this->configArray = new ConfigArray($ini);
    }

    public function count() {
        return count($this->configArray);
    }

}

?>
