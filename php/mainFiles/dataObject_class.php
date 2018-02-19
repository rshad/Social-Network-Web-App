<?php

/**
 * Created by PhpStorm.
 * User: Rshad
 * Date: 05/05/2017
 * Time: 13:24
*/

include_once ("configuracion.inc.php");

abstract class dataObject_class
{

    protected $data = array();
    public function __construct()
    {
    }

    public function __dataArray( $data ) {
        foreach ( $data as $key => $value )
            if ( array_key_exists( $key, $this->data ) )
                $this->data[$key] = $value;
    }

    public function returnValue( $index_name ) {
        if ( array_key_exists( $index_name, $this->data ) ) {
            return $this->data[$index_name];
        } else die( "index not found" );
    }
    protected static function conect() {
        try {
            $connection = new PDO( DB_DSN, DB_USER, DB_PASSWORD);
            // Se permite a PHP que mantenga la conexión MySQL abierta para
            // que se emplee en otras partes de la aplicación.
            $connection->setAttribute( PDO::ATTR_PERSISTENT, true );
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        } catch ( PDOException $error ) {
            die( "Connectin failed: " . $error->getMessage() );
        }
        return $connection;
    }
    protected static function disconnect( $connection) {
        $connection = "";
    }
}