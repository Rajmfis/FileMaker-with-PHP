<?php 
session_start();

// Unset all of the session variables.
// $_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
// if (ini_get("session.use_cookies")) {
//     $params = session_get_cookie_params();
//     setcookie(session_name(), '', time() - 42000,
//         $params["path"], $params["domain"],
//         $params["secure"], $params["httponly"]
//     );
// }

// unset($_SESSION["email"]); 
// unset($_SESSION["password"]);

// unset($_SESSION["firstname"]); 
// unset($_SESSION["lastname"]);
// unset($_SESSION["contactno"]); 

unset($_SESSION["id"]);
session_destroy();
// header("Location: login.html");
// session_start();
// unset($_SESSION["firstname"]);
// unset($_SESSION["lastname"]);
// unset($_SESSION["contactno"]);

// if(isset($_GET["session_expired"])) {
// 	$url .= "?session_expired=" . $_GET["session_expired"];
// }
header("Location: index.html");
?>