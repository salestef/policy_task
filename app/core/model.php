<?php
abstract class Model{

    /** @var PDO $db Initializes connection with a database that can later be used in child controllers. */
    public $db = null;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->db = DB::connect();
    }
}