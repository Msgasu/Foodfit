  <?php
// Check if constants are not defined before defining them
if (!defined('HOST')) {
    define("HOST", "127.0.0.1");
}
if (!defined('DB_NAME')) {
    define("DB_NAME", "food_fit");
}
if (!defined('USERNAME')) {
    define("USERNAME", "root");
}
if (!defined('PASSWORD')) {
    define("PASSWORD", "xGGLfu0Owq:A");
}

$mysqli = new mysqli(HOST, USERNAME, PASSWORD, DB_NAME);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?> 
