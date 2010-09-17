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

abstract class Registry {

    private static $registry = array();

    public static function set($key, $value) {
        if(!self::has($key)) {
            self::$registry[$key] = $value;
        } else {
            throw new \Exception('Registry key `$key` is already set.');
        }
    }

    public static function get($key) {
        if(self::has($key)) {
            return self::$registry[$key];
        }
        return null;
    }

    public static function has($key) {
        if(isset(self::$registry[$key])) {
            return true;
        }
        return false;
    }
}

?>
