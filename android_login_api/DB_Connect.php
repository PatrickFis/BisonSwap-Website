<?php
class DB_Connect {
    private $conn;

    // Connecting to database
    public function connect() {
        require_once '../dbconnect.php';

        // Connecting to mysql database
        $this->conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

        // return database handler
        return $this->conn;
    }
}

?>
