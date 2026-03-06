<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Fungsi pembantu untuk mengambil Environment Variables di Vercel yang kadang tidak terbaca oleh getenv() biasa
function get_env_var($key, $default = "")
{
    if (isset($_ENV[$key]) && !empty($_ENV[$key]))
        return $_ENV[$key];
    if (isset($_SERVER[$key]) && !empty($_SERVER[$key]))
        return $_SERVER[$key];
    if ($val = getenv($key))
        return $val;
    return $default;
}

$host = get_env_var('DB_HOST', 'localhost');
$user = get_env_var('DB_USER', 'root');
$pass = get_env_var('DB_PASS', '');
$db = get_env_var('DB_NAME', 'sid_premium');
$port = get_env_var('DB_PORT', '3306');

try {
    mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR);

    // Vercel / serverless workaround: force TCP instead of unix socket for 'localhost' fallback
    $connect_host = ($host === 'localhost') ? '127.0.0.1' : $host;

    $conn = mysqli_init();

    // Bypass timeout Vercel yang kadang lama
    $conn->options(MYSQLI_OPT_CONNECT_TIMEOUT, 10);

    // Konfigurasi ini sangat penting untuk mendukung Aiven yang mewajibkan mode SSL (REQUIRED)
    if ($host !== 'localhost' && $host !== '127.0.0.1') {
        $conn->ssl_set(NULL, NULL, NULL, NULL, NULL);
        $conn->real_connect($connect_host, $user, $pass, $db, (int) $port, null, MYSQLI_CLIENT_SSL);
    } else {
        $conn->real_connect($connect_host, $user, $pass, $db, (int) $port);
    }

} catch (Exception $e) {
    die("<h1>Database Connection Failed / Gagal Terhubung</h1>
         <p>Sepertinya Vercel gagal terhubung ke database Aiven Anda.</p>
         <hr>
         <strong>Diagnostic Info (Informasi Debug):</strong>
         <ul>
            <li>Host yang dicoba: <strong>" . htmlspecialchars($host) . "</strong></li>
            <li>Port yang dicoba: <strong>" . htmlspecialchars($port) . "</strong></li>
            <li>User yang dicoba: <strong>" . htmlspecialchars($user) . "</strong></li>
            <li>Database yang dicoba: <strong>" . htmlspecialchars($db) . "</strong></li>
         </ul>
         <p><strong>Pesan Error Asli:</strong> " . htmlspecialchars($e->getMessage()) . "</p>
         <hr>
         <p>Jika <b>Host yang dicoba</b> masih bertuliskan <i>localhost</i>, berarti Environment Variables Anda belum tersimpan/terbaca oleh Vercel. Pastikan Anda sudah membuat variabelnya di Vercel Settings lalu tekan tombol <b>Redeploy</b>.</p>");
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