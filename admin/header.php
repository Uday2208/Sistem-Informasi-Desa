<?php
session_start();
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../config/helpers.php";

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard SID</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Quill.js CSS & JS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f6f9;
            color: #333;
        }

        /* Navbar Styling */
        .navbar-custom {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding-top: 0.8rem;
            padding-bottom: 0.8rem;
        }

        .navbar-custom .navbar-brand {
            font-weight: 700;
            letter-spacing: 0.5px;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-custom .nav-link {
            color: rgba(255, 255, 255, 0.8);
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.2s ease;
            border-radius: 8px;
            margin: 0 2px;
        }

        .navbar-custom .nav-link:hover,
        .navbar-custom .nav-link:focus {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .navbar-custom .dropdown-menu {
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            padding: 10px;
            margin-top: 10px;
        }

        .navbar-custom .dropdown-item {
            border-radius: 6px;
            padding: 8px 15px;
            font-weight: 500;
            color: #475569;
            transition: all 0.2s;
        }

        .navbar-custom .dropdown-item:hover {
            background-color: #f1f5f9;
            color: #0f172a;
            transform: translateX(3px);
        }

        .navbar-custom .dropdown-item i {
            width: 20px;
            color: #64748b;
        }

        .navbar-custom .dropdown-item:hover i {
            color: #0d6efd;
        }

        /* Main Content Container */
        .main-container {
            margin-top: 2rem;
            margin-bottom: 3rem;
        }

        /* Dashboard Cards */
        .dash-card {
            border-radius: 16px;
            border: none;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .dash-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .dash-card .card-body {
            padding: 1.5rem;
            position: relative;
            z-index: 1;
        }

        .dash-card .card-icon {
            position: absolute;
            right: -10px;
            bottom: -10px;
            font-size: 5rem;
            opacity: 0.15;
            z-index: 0;
            transform: rotate(-15deg);
            transition: all 0.4s ease;
        }

        .dash-card:hover .card-icon {
            transform: rotate(0deg) scale(1.1);
            opacity: 0.25;
        }

        .dash-card .card-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0;
        }

        .dash-card .card-text {
            font-size: 1.1rem;
            font-weight: 500;
            opacity: 0.9;
        }

        /* Card Gradients */
        .bg-gradient-primary {
            background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);
            color: white;
        }

        .bg-gradient-success {
            background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
            color: white;
        }

        .bg-gradient-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
            color: white;
        }

        .bg-gradient-danger {
            background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
            color: white;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-shield-alt text-primary"></i>
                <span>Admin Panel</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="adminNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><i class="fas fa-home me-1"></i> Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="webLayout" role="button"
                            data-bs-toggle="dropdown">
                            <i class="fas fa-desktop me-1"></i> FrontEnd & Web
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="banner.php"><i class="far fa-images"></i> Banner
                                    Slider</a></li>
                            <li><a class="dropdown-item" href="pengumuman.php"><i class="fas fa-bullhorn"></i> Running
                                    Text Info</a></li>
                            <li><a class="dropdown-item" href="faq.php"><i class="far fa-question-circle"></i> Soal &
                                    Jawaban (FAQ)</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="masterData" role="button"
                            data-bs-toggle="dropdown">
                            <i class="fas fa-database me-1"></i> Modul Warga
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="berita.php"><i class="far fa-newspaper"></i>
                                    Berita/Artikel</a></li>
                            <li><a class="dropdown-item" href="umkm.php"><i class="fas fa-store"></i> Katalog UMKM</a>
                            </li>
                            <li><a class="dropdown-item" href="layanan.php"><i class="fas fa-concierge-bell"></i>
                                    Layanan Administrasi</a></li>
                            <li><a class="dropdown-item" href="galeri.php"><i class="far fa-images"></i> Galeri
                                    Kegiatan</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="konfigurasi" role="button"
                            data-bs-toggle="dropdown">
                            <i class="fas fa-cog me-1"></i> Pengaturan Lembaga
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="profil.php"><i class="far fa-id-card"></i> Profil, Visi &
                                    Misi</a></li>
                            <li><a class="dropdown-item" href="pegawai.php"><i class="fas fa-users"></i> Staf &
                                    Aparatur</a></li>
                            <li><a class="dropdown-item" href="kontak.php"><i class="fas fa-map-marker-alt"></i> Lokasi
                                    & Kontak</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                    <li class="nav-item me-2">
                        <a class="btn btn-outline-light btn-sm rounded-pill px-3" href="<?= $domain ?>/"
                            target="_blank">
                            <i class="fas fa-external-link-alt me-1"></i> Lihat Web
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-danger btn-sm rounded-pill px-3" href="logout.php">
                            <i class="fas fa-sign-out-alt me-1"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container main-container">