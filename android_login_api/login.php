login.php
<?php
require_once 'DB_functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['email']) && isset($_POST['password'])) {

    // receiving the post params
    $email = $_POST['email'];
    $password = $_POST['password'];

    // get the user by email and password
    $user = $db->getUserByEmailAndPassword($email, $password);
    // echo "Got username and pass\n";
    if ($user != false) {
        // User was found with supplied credintials
        $response["error"] = FALSE;
        $response["user"]["email"] = $user["email"];
        echo json_encode($response);
    } else {
        // User was not found with supplied credintials
        $response["error"] = TRUE;
        $response["error_msg"] = "Login credentials are wrong. Please try again!";
        echo json_encode($response);
    }
} else {
    // Missing a required parameters
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters email or password is missing!";
    echo json_encode($response);
}
?>
