<?php
namespace models;


use lib\Db;
use PDO;

class Company
{
    /**
     * @var
     */
    protected $db;

    function __construct()
    {
        $this->db = Db::getInstance();
    }

    /**
     * @return array
     */
    public function fetchAll()
    {
        $stmt = $this->db->prepare( "SELECT * FROM companies" );

        if( $stmt->execute() )
            return $stmt->fetchAll( PDO::FETCH_ASSOC );

        return null;
    }

    /**
     * @return array
     */
    public function fetchById( $id )
    {
        $stmt = $this->db->prepare( "SELECT * FROM companies WHERE company_id = ?" );

        if( $stmt->execute( array( $id ) ) )
            return $stmt->fetch( PDO::FETCH_ASSOC );

        return null;
    }

    /**
     * Update company details
     *
     * @param string $id
     * @param string $name
     * @param string $url
     *
     * @return string
     */
    public function update( $id, $name, $url )
    {
        $stmt = $this->db->prepare( "UPDATE companies SET name = ?, url = ?, date_modified = CURRENT_TIMESTAMP WHERE company_id = ?" );

        return $stmt->execute( array( $name, $url, $id ) );
    }
}