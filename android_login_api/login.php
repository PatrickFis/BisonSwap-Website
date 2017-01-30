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
    echo "Got username and pass\n";
    if ($user != false) {
        // use is found
        echo "User not found\n";
        $response["error"] = FALSE;
        $response["user"]["email"] = $user["email"];
        echo json_encode($response);
    } else {
        // user is not found with the credentials
        echo "Credentials wrong\n";
        $response["error"] = TRUE;
        $response["error_msg"] = "Login credentials are wrong. Please try again!";
        echo json_encode($response);
    }
} else {
    // required post params is missing
    echo "Logged in\n";
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters email or password is missing!";
    echo json_encode($response);
}
?>
