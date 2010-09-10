<?php
namespace MongoUI\Core;

class Common {

    public static function getRequestVar() {

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

}

?>
