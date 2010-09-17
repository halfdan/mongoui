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
namespace MongoUI\Modules;

class Login extends \MongoUI\Core\Controller {

    public function index() {
        $template = new \MongoUI\Core\Template();
        $template->setTemplate('index.tpl');
        $this->renderTemplate($template);
    }

    public function auth() {
        $result = array(
            "success" => true,
            "message" => "Wrong username or password"
        );
        echo json_encode($result);
    }
}
?>
