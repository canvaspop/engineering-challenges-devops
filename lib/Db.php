<?php

namespace lib;


use PDO;

class Db
{
    /**
     * Database connection handle
     *
     * @var PDO
     */
    public static $dbh;

    /**
     * Get database dsn string
     *
     * @return string
     */
    private static function getDSN()
    {
        return 'mysql:host=' . Config::read( 'db.host' ) .
        ';dbname=' . Config::read( 'db.basename' ) .
        ';port=' . Config::read( 'db.port' ) .
        ';connect_timeout=15';
    }

    /**
     * Get database connection user
     *
     * @return string
     */
    private static function getUser()
    {
        return Config::read( 'db.user' );
    }

    /**
     * Get database connection password
     *
     * @return string
     */
    private static function getPassword()
    {
        return Config::read( 'db.password' );
    }

    public static function getInstance()
    {
        if( !isset( self::$dbh ) )
        {
            self::$dbh = new PDO( self::getDSN(), self::getUser(), self::getPassword() );
        }

        return self::$dbh;
    }
}