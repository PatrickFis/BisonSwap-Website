<?php
class DB_Functions {

    private $conn;

    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }

    // destructor
    function __destruct() {

    }

    /**
     * Storing new user
     * returns user details
     */
    public function storeUser($email, $password) {
	  // echo "Got to store user in DB_functions \n";
        $uuid = uniqid('', true);
        $hash = $this->hashSSHA($password);
        $encrypted_password = $hash; // encrypted password
        // $salt = $hash["salt"]; // salt
	      // echo "Got encrypted pass\n";
        $stmt = $this->conn->prepare("INSERT INTO users(email, password) VALUES(?, ?)");
        // echo "Prepared statement\n";
        // echo "Before bind\n";
        $stmt->bind_param("ss", $email, $encrypted_password);
        // echo "Bind statement\n";
        $result = $stmt->execute();
      	// printf("Error: %s\n", $stmt->conn->connect_error);
      	// printf("Error: %s\n", $stmt->conn->error);
        $stmt->close();

        // check for successful store
        // Fix this later
        if ($result) {
            $query = "SELECT * FROM users WHERE email = $email";
            $result = $this->conn->query($query);
            $row = $result->fetch_row();
            $user = $row;
            return $user;
            // $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
            // $stmt->bind_param("s", $email);
            // $stmt->execute();
            // $user = $stmt->get_result()->fetch_assoc();
            // $stmt->close();
		        // //echo "Got to stmt close\n";
            // return $user;
        } else {
            // echo "Got to else";
            return false;
        }
    }

    /**
     * Get user by email and password
     */
    public function getUserByEmailAndPassword($email, $password) {

        // $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        // $stmt->bind_param("s", $email);
        // Had to migrate away from prepared statements and use queries
        $query = "SELECT * FROM users where email = '$email'";
        // echo $query;
        if($result = $this->conn->query($query)) {
          while($row = $result->fetch_row()) {
            // printf("%s %s %s\n", $row[0], $row[1], $row[2]);
            // $array = [$row[0], $row[1], $row[2]];
            // print_r($array);
            $encrypted_password = $row[2];
            if(strcmp($this->hashSSHA($password), $encrypted_password) == 0) {
              // Password matches the stored password
              $user["error"] = false;
              $user["idusers"] = $row[0];
              $user["email"] = $row[1];
              $result->close();
              // print_r($user);
              return $user;
            }
          }
          $result->close();
        }

        // if ($stmt->execute()) {
        //     $user = $stmt->get_result()->fetch_assoc();
        //     $stmt->close();
        //
        //     // Verify the user's password
        //     $userPass = $user['password'];
        //     // $salt = $user['salt'];
        //     // $encrypted_password = $user['encrypted_password'];
        //     $hash = $this->hashSSHA($password);
        //     // check for password equality
        //     if ($userPass == $hash) {
        //         // user authentication details are correct
        //         return $user;
        //     }
        // } else {
        //     return NULL;
        // }
    }

    /**
     * Check user is existed or not
     */
    public function userExists($email) {
        $stmt = $this->conn->prepare("SELECT email from users WHERE email = ?");

        $stmt->bind_param("s", $email);

        $stmt->execute();

        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // user existed
            $stmt->close();
            return true;
        } else {
            // user not existed
            $stmt->close();
            return false;
        }
    }

    /**
     * Encrypting password
     * @param password
     * returns salt and encrypted password
     */

      /*
       *  Modified this to return an encrypted password. May need to change other portions
       *  of code.
       *
       */
    public function hashSSHA($password) {

      $encrypted = hash('sha256', $password);
      return $encrypted;
        // $salt = sha1(rand());
        // $salt = substr($salt, 0, 10);
        // $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        // $hash = array("salt" => $salt, "encrypted" => $encrypted);
        // return $hash;
    }

    /**
     * Decrypting password
     * @param salt, password
     * returns hash string
     */
    public function checkhashSSHA($salt, $password) {

        $hash = base64_encode(sha1($password . $salt, true) . $salt);

        return $hash;
    }

}

?>
