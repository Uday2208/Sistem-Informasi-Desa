<?php
session_start();
require_once __DIR__ . "/../config/database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['admin'] = $user['id'];

        // Vercel serverless session workaround
        setcookie('admin_session', $user['id'], time() + (86400 * 30), "/");

        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1), 0 5px 15px rgba(0, 0, 0, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            transform: translateY(0);
            transition: all 0.3s ease;
            max-width: 450px;
            width: 100%;
            margin: 0 15px;
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            color: white;
            padding: 30px 20px 20px;
            text-align: center;
            border-bottom-left-radius: 50% 10px;
            border-bottom-right-radius: 50% 10px;
        }

        .login-header h3 {
            font-weight: 700;
            margin-bottom: 5px;
            letter-spacing: -0.5px;
        }

        .login-header p {
            font-size: 0.9rem;
            opacity: 0.8;
            margin: 0;
        }

        .login-body {
            padding: 40px 30px;
        }

        .form-floating>.form-control:focus~label::after,
        .form-floating>.form-control:not(:placeholder-shown)~label::after {
            background-color: transparent !important;
        }

        .form-floating>label {
            color: #6c757d;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #ced4da;
            padding: 1rem 1rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
            border-color: #0d6efd;
            transform: translateY(-2px);
        }

        .input-group-text {
            background: transparent;
            border-right: none;
            color: #adb5bd;
        }

        .form-control.with-icon {
            border-left: none;
        }

        .btn-login {
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            font-size: 1.1rem;
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            border: none;
            transition: all 0.3s;
            box-shadow: 0 4px 10px rgba(13, 110, 253, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(13, 110, 253, 0.4);
            background: linear-gradient(135deg, #0b5ed7 0%, #094cae 100%);
        }

        /* Decorative circles */
        .circle-1,
        .circle-2 {
            position: absolute;
            border-radius: 50%;
            z-index: -1;
        }

        .circle-1 {
            width: 300px;
            height: 300px;
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.1) 0%, rgba(13, 110, 253, 0) 100%);
            top: -50px;
            left: -50px;
        }

        .circle-2 {
            width: 400px;
            height: 400px;
            background: linear-gradient(135deg, rgba(2dc255, 0.1) 0%, rgba(2dc255, 0) 100%);
            bottom: -100px;
            right: -100px;
        }
    </style>
</head>

<body>
    <div class="circle-1"></div>
    <div class="circle-2"></div>

    <div class="login-card">
        <div class="login-header">
            <h3><i class="fas fa-shield-alt me-2"></i>Admin SID</h3>
            <p>Sistem Informasi Desa Premium</p>
        </div>

        <div class="login-body">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i><?= $error ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <div class="form-floating flex-grow-1">
                            <input type="text" name="username" class="form-control with-icon" id="username"
                                placeholder="Username" required>
                            <label for="username">Username</label>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <div class="form-floating flex-grow-1">
                            <input type="password" name="password" class="form-control with-icon" id="password"
                                placeholder="Password" required>
                            <label for="password">Password</label>
                        </div>
                    </div>
                </div>

                <div class="d-grid mt-5">
                    <button type="submit" class="btn btn-primary btn-login">
                        Login <i class="fas fa-sign-in-alt ms-2"></i>
                    </button>
                </div>
            </form>

            <div class="text-center mt-4">
                <a href="../" class="text-decoration-none text-muted small">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>