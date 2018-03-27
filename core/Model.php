<?php

namespace Core;

/***
 * Class Model.
 */
class Model
{
    /**
     * @var \PDO
     */
    protected static $db;

    /**
     * @param \PDO $db
     * @return \PDO
     */
    public static function setDb(\PDO $db)
    {
        if (!self::$db) {
            self::$db = $db;
            self::$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }

        return self::$db;
    }
}
