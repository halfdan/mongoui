<?php
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
