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

/**
 * Auto loader
 *
 * @package Core
 */
class Loader
{
	/**
	 * Get class file name
	 *
	 * @param string $class Class name
	 * @return string Class file name
	 * @throws Exception if class name is invalid
	 */
	protected static function getClassFileName($class)
	{
		if(substr($class, 0, 8) == 'MongoUI\\')
		{
			$class = substr($class, 8);
		}

		$parts = explode('\\', $class);

		// If namespaced
		if(count($parts) > 1) {
			$class = array_pop($parts);
			$parts = array_map('strtolower', $parts);
			array_push($parts, $class);
			return implode(DIRECTORY_SEPARATOR, $parts);
		}
		else {
		        return $class;
		}
	}

	/**
	 * Load class by name
	 *
	 * @param string $class Class name
	 * @throws Exception if class not found
	 */
	public static function loadClass($class)
	{
		$classPath = self::getClassFileName($class);

		if(file_exists($classPath.'.php')) {
			require_once MONGOUI_ROOT . DIRECTORY_SEPARATOR . $classPath . '.php';
		}
		else {
			throw new \Exception('Class {$class} not found!');
		}
	}

	/**
	 * Autoloader
	 *
	 * @param string $class Class name
	 */
	public static function autoload($class)
	{
		try {
			@self::loadClass($class);
		} catch (Exception $e) {
		}
	}
}

// Note: only one __autoload per PHP instance
if(function_exists('spl_autoload_register'))
{
	// use the SPL autoload stack
	spl_autoload_register(array('MongoUI\Core\Loader', 'autoload'));

	// preserve any existing __autoload
	if(function_exists('__autoload'))
	{
		spl_auto_register('__autoload');
	}
}
else
{
	function __autoload($class)
	{
		MongoUI\Core\Loader::autoload($class);
	}
}
