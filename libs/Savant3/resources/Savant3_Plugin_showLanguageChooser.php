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
* Show a drop down box which enables language selection
* in MongoUI
*
* @package Savant3
* 
* @author Fabian Becker <halfdan@xnorfz.de>
* 
*/
class Savant3_Plugin_showLanguageChooser extends Savant3_Plugin {

	/**
         * Show a drop down box which enables language selection in MongoUI
         * 
         * @param boolean $return If true it returns the HTML.
         */
	public function showLanguageChooser($return = false)
	{
		$translate = \MongoUI\Core\Translate::getInstance();
                $languages = $translate->getAvailableLanguages();

                $options = '';

                foreach($languages as $language) {
                    $options .= sprintf('<option value="%s">%s</option>\n', $language[0], $language[1]);
                }

                $html = <<<EOF
<div id="languageChooser">
<form method="get">
    <select name="lang" onchange="this.form.submit()">
        $options
    </select>
</form>
</div>
EOF;

                if(!$return) {
                    echo $html;
                } else {
                    return $html;
                }
	}
}
?>