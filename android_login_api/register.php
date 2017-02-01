register.php
<?php

require_once 'DB_functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['email']) && isset($_POST['password'])) {

    // receiving the post params
    // $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // echo $email.$password;
    // check if user is already existed with the same email
    if ($db->userExists($email)) {
        // User already exists
        $response["error"] = TRUE;
        $response["error_msg"] = "User already exists with email: " . $email;
        echo json_encode($response);
    } else {
        // create a new user
	      // echo "Got to store user\n";
        $user = $db->storeUser($email, $password);
 if ($user) {
            // user stored successfully
            $response["error"] = FALSE;
            // $response["user"]["name"] = $user["name"];
            $response["user"]["email"] = $user["email"];
            echo json_encode($response);
        } else {
            // user failed to store
            $response["error"] = TRUE;
            $response["error_msg"] = "Unknown error occurred in registration!";
            echo json_encode($response);
        }
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters (name, email or password) is missing!";
    echo json_encode($response);
}
?>
