<?php
namespace models;


use lib\Memcached;

class Location
{
    /**
     * @var
     */
    protected $memcached;

    function __construct()
    {
        $this->memcached = new Memcached();
    }

    /**
     * @return array
     */
    public function fetchAll()
    {
        return $this->memcached->get( 'locations' );
    }

    /**
     * Populate cached list of locations
     */
    public function populate()
    {
        $locations = array(
            array(
                'location_id' => 1,
                'name'        => 'Ottawa',
                'created'     => date( 'Y-m-d H:i:s' )
            ),
            array(
                'location_id' => 2,
                'name'        => 'Las Vegas',
                'created'     => date( 'Y-m-d H:i:s' )
            )
        );

        $this->memcached->set( 'locations', $locations );
    }
}