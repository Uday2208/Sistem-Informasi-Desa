<?php
require_once "config/database.php";

$meta_title = isset($page_title) ? $page_title . " - " . $site_title : $site_title;
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= htmlspecialchars($meta_title) ?>
    </title>

    <?php if (!empty($favicon)): ?>
        <link rel="icon" href="<?= $domain ?>/uploads/<?= htmlspecialchars($favicon) ?>">
    <?php endif; ?>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= $domain ?>/assets/css/style.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top navbar-glass">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="<?= $domain ?>/">
                <?php if (!empty($logo)): ?>
                    <img src="<?= $domain ?>/uploads/<?= htmlspecialchars($logo) ?>" alt="Logo" height="40"
                        class="rounded-circle shadow-sm" style="object-fit: cover;">
                <?php else: ?>
                    <i class="fas fa-landmark text-primary"></i>
                <?php endif; ?>
                <span><?= htmlspecialchars($site_title) ?></span>
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <i class="fas fa-bars fs-3 text-primary"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center fw-medium mt-3 mt-lg-0">
                    <li class="nav-item"><a class="nav-link" href="<?= $domain ?>/"><i
                                class="fas fa-home me-2 d-lg-none"></i>Beranda</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profilDropdown" role="button"
                            data-bs-toggle="dropdown">
                            <i class="fas fa-info-circle me-2 d-lg-none"></i>Tentang Kami
                        </a>
                        <ul class="dropdown-menu border-0 shadow-sm rounded-4 mt-2">
                            <li><a class="dropdown-item py-2" href="<?= $domain ?>/profil">Profil & Sejarah</a></li>
                            <li><a class="dropdown-item py-2" href="<?= $domain ?>/aparatur">Aparatur Pemerintahan</a>
                            </li>
                            <li><a class="dropdown-item py-2" href="<?= $domain ?>/faq">FAQ (Tanya Jawab)</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="<?= $domain ?>/"><i
                                class="fas fa-concierge-bell me-2 d-lg-none"></i>Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $domain ?>/umkm"><i
                                class="fas fa-store me-2 d-lg-none"></i>UMKM</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $domain ?>/galeri"><i
                                class="far fa-images me-2 d-lg-none"></i>Galeri</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $domain ?>/berita"><i
                                class="far fa-newspaper me-2 d-lg-none"></i>Berita</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $domain ?>/kontak"><i
                                class="fas fa-envelope me-2 d-lg-none"></i>Kontak</a></li>
                    <li class="nav-item ms-lg-3 mt-3 mt-lg-0"><a class="btn btn-modern btn-primary-modern w-100"
                            href="<?= $domain ?>/admin"><i class="fas fa-sign-in-alt me-1"></i> Admin</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div style="height: 80px;"></div>