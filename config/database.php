<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$host = getenv('DB_HOST') ?: "localhost";
$user = getenv('DB_USER') ?: "root";
$pass = getenv('DB_PASS') ?: "";
$db = getenv('DB_NAME') ?: "sid_premium";
$port = getenv('DB_PORT') ?: "3306";

try {
    // Vercel / serverless workaround: force TCP instead of unix socket for 'localhost' fallback
    $connect_host = ($host === 'localhost') ? '127.0.0.1' : $host;

    $conn = mysqli_init();
    // Konfigurasi ini sangat penting untuk mendukung Aiven yang mewajibkan mode SSL (REQUIRED)
    $conn->ssl_set(NULL, NULL, NULL, NULL, NULL);
    $conn->real_connect($connect_host, $user, $pass, $db, (int) $port, null, MYSQLI_CLIENT_SSL);

    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    die("<h1>Database Connection Failed / Belum Dikonfigurasi</h1>
         <p>Sepertinya Environment Variables (DB_HOST, dsb) belum diatur di Vercel.</p>
         <p>Error Detail: " . htmlspecialchars($e->getMessage()) . "</p>
         <p>Silahkan atur <strong>DB_HOST, DB_USER, DB_PASS, DB_NAME</strong> di pengaturan Vercel -> Settings -> Environment Variables, lalu deploy ulang.</p>");
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