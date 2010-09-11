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

/**
* 
* Translates a string inside a template.
*
* @package Savant3
* 
* @author Fabian Becker <halfdan@xnorfz.de>
* 
*/
class Savant3_Plugin_translate extends Savant3_Plugin {

	/**
	* 
	* Translate a string inside a template
	* 
	* @access public
	* 
	* @param string|array $href A string URL for the resulting tag.  May
	* also be an array with any combination of the keys 'scheme',
	* 'host', 'path', 'query', and 'fragment' (c.f. PHP's native
	* parse_url() function).
	* 
	* @param string $string The string to be translated.
	* @param array $args Optional arguments.
	* 
	* @return string The translated string.
	* 
	*/
	
	public function translate($string,$args=array())
	{
		$translate = \MongoUI\Core\Translate::getInstance();
                return $translate->getTranslation($string,$args);
	}
}
?>