<?php

class DB {

    /** @var PDO $connection Database connection.  */
	private static $connection = null;

    /** Don't allow use of constructor */
    private function __construct(){}

    /**
     * Uses Singleton pattern to open and use only one Database connection.
     * Params for DB connection are located in DB config file.
     * @return PDO Database connection.
     */
	public static function connect(){
        if ( is_null( static::$connection ) ) {
            try {
                static::$connection = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME. ';charset=' . DB_CHARSET,DB_USER,DB_PASS);
            } catch ( PDOException $e){
                die ( $e->getMessage() );
            }
        }
        return static::$connection;
	}
}
