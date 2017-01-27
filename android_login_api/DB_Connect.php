<?php
class DB_Connect {
    private $conn;

    // Connecting to database
    public function connect() {
        // require_once '../dbconnect.php';

        // Connecting to mysql database
				$DBHOST = 'localhost';
				$DBUSER = 'root';
				$DBPASS = '';
				$DBNAME = 'bisonswap';
        $this->conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

        // return database handler
        return $this->conn;
    }
}

?>
