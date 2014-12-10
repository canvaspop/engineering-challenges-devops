<?php

namespace lib;


use Memcache;

class Memcached
{
    /**
     * Memcached connection handle
     *
     * @var Memcache
     */
    public $memcached;

    /**
     * Get the memcached connection instance
     *
     * @return Memcache
     */
    public function getInstance()
    {
        if( !isset( $this->memcached ) )
        {
            $this->memcached = new Memcache();
            $this->memcached->connect( Config::read( 'memcached.host' ), Config::read( 'memcached.port' ) );
        }

        return $this->memcached;
    }

    /**
     * Retrieve a value from memcached
     *
     * @param $key
     *
     * @return array|string
     */
    public function get( $key )
    {
        return unserialize( $this->getInstance()->get( $key ) );
    }

    /**
     * Set a value in memcached
     *
     * @param $key
     *
     * @return array|string
     */
    public function set( $key, $value )
    {
        return $this->getInstance()->set( $key, serialize( $value ) );
    }
}