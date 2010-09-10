<?php
// To ease working with some classes/methods we build up a small set of functions here

function Translate($string, $args = array())
{
        return MongoUI\Core\Translate::getInstance()->getTranslation($string, $args);
}
