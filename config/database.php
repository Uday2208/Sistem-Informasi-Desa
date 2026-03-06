<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$host = getenv('DB_HOST') ?: "localhost";
$user = getenv('DB_USER') ?: "root";
$pass = getenv('DB_PASS') ?: "";
$db = getenv('DB_NAME') ?: "sid_premium";
$port = getenv('DB_PORT') ?: "3306";

$conn = new mysqli($host, $user, $pass, $db, (int) $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to get setting
function get_setting($conn, $key)
{
    $stmt = $conn->prepare("SELECT value FROM settings WHERE key_name = ?");
    $stmt->bind_param("s", $key);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->num_rows > 0) {
        return $res->fetch_assoc()['value'];
    }
    return "";
}

$site_title = get_setting($conn, 'site_title');
$global_meta_desc = get_setting($conn, 'meta_description');
$global_meta_keys = get_setting($conn, 'meta_keywords');
$global_meta_author = get_setting($conn, 'meta_author');
$domain = get_setting($conn, 'domain');
$favicon = get_setting($conn, 'favicon');
$logo = get_setting($conn, 'logo');
?>