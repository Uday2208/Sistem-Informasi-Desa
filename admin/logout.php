<?php
session_start();
session_destroy();
// Clear cookie for Vercel
setcookie('admin_session', '', time() - 3600, "/");

header("Location: login.php");
exit;
