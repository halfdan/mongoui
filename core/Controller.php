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

abstract class Controller {

    public function __construct() {

    }

    /**
     * Returns the name of the default method that will be called
     * when visiting: index.php?module=<name> without an action.
     *
     * @return string
     */
    public function getDefaultAction() {
        return 'index';
    }


    public function renderTemplate(\MongoUI\Core\Template $template, $fetch = false) {
        $theme = \MongoUI\Core\Common::getCurrentTheme();
        $className = end(explode("\\", \get_called_class()));
        $templatePath = MONGOUI_ROOT . '/themes/' . $theme . '/' . $className;
        $template->setPath('template', $templatePath);

        if($fetch)
            return $template->fetch();
        else
            $template->display();
    }

}
