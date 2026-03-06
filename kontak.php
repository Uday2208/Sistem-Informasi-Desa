<?php
$page_title = "Kontak & Lokasi";
require_once "header.php";

$page_meta_desc = "Informasi kontak, lokasi peta google maps, dan alamat resmi " . $site_title;
?>
<!-- Modern Hero Header -->
<div class="position-relative overflow-hidden mb-5"
    style="background: linear-gradient(135deg, rgba(15,23,42,0.9), rgba(2,132,199,0.8)), url('https://picsum.photos/seed/kantordesa/1920/600') no-repeat center center/cover; padding: 150px 0 100px;">
    <div class="container position-relative z-1 text-center text-white mt-4">
        <span class="badge bg-white text-primary rounded-pill px-3 py-2 fw-medium mb-3 shadow-sm">
            <i class="fas fa-headset me-1"></i> Hubungi Kami
        </span>
        <h1 class="display-4 fw-bold brand-font mb-3 text-shadow">Kontak & Lokasi</h1>
        <p class="lead fw-light opacity-75 mx-auto" style="max-width: 600px;">
            Mari Lakukan Komunikasi, Kami Siap Melayani 1x24 Jam Lewat Kanal Tersedia
        </p>
    </div>
</div>

<div class="container mb-5 pb-5">
    <div class="row g-0 bg-white card-modern overflow-hidden"
        style="margin-top: -100px; position:relative; z-index:10; border-radius: 20px;">
        <div class="col-xl-4 col-lg-5 p-5"
            style="background: linear-gradient(135deg, var(--primary-dark), var(--primary-color));">
            <h3 class="fw-bold mb-5 brand-font text-white">Informasi Kontak</h3>

            <div class="d-flex align-items-start mb-4">
                <div class="bg-white text-primary rounded-circle p-3 me-3 d-flex justify-content-center align-items-center shadow-sm"
                    style="width: 50px; height: 50px;">
                    <i class="fas fa-map-marker-alt fs-5"></i>
                </div>
                <div class="text-white">
                    <h5 class="fw-bold mb-1">Alamat Balai Desa</h5>
                    <p class="text-white-50 mb-0 form-text"><?= nl2br(htmlspecialchars(get_setting($conn, 'alamat'))) ?>
                    </p>
                </div>
            </div>

            <div class="d-flex align-items-start mb-4">
                <div class="bg-white text-primary rounded-circle p-3 me-3 d-flex justify-content-center align-items-center shadow-sm"
                    style="width: 50px; height: 50px;">
                    <i class="fas fa-phone-alt fs-5"></i>
                </div>
                <div class="text-white">
                    <h5 class="fw-bold mb-1">Telepon / WhatsApp</h5>
                    <p class="text-white-50 mb-0"><a
                            href="https://wa.me/<?= htmlspecialchars(get_setting($conn, 'whatsapp')) ?>"
                            class="text-white-50 text-decoration-none hover-text-white"
                            target="_blank">+<?= htmlspecialchars(get_setting($conn, 'whatsapp')) ?></a></p>
                </div>
            </div>

            <div class="d-flex align-items-start mb-5">
                <div class="bg-white text-primary rounded-circle p-3 me-3 d-flex justify-content-center align-items-center shadow-sm"
                    style="width: 50px; height: 50px;">
                    <i class="fas fa-envelope fs-5"></i>
                </div>
                <div class="text-white">
                    <h5 class="fw-bold mb-1">Surat Elektronik (Email)</h5>
                    <p class="text-white-50 mb-0"><a href="mailto:<?= htmlspecialchars(get_setting($conn, 'email')) ?>"
                            class="text-white-50 text-decoration-none hover-text-white"><?= htmlspecialchars(get_setting($conn, 'email')) ?></a>
                    </p>
                </div>
            </div>

            <hr class="border-white opacity-25 mb-4">
            <div class="text-white">
                <h5 class="fw-bold mb-2 brand-font"><i class="far fa-clock me-2"></i> Jadwal Operasional</h5>
                <p class="text-white-50 mb-0"><?= htmlspecialchars(get_setting($conn, 'jam_kerja')) ?></p>
            </div>
        </div>

        <div class="col-xl-8 col-lg-7 p-0 m-0" style="min-height: 400px;">
            <!-- Peta Google Maps Full Iframe -->
            <div class="w-100 h-100 map-container">
                <?= get_setting($conn, 'map_iframe') ?>
            </div>
        </div>
    </div>
</div>

<style>
    .map-container iframe {
        width: 100% !important;
        height: 100% !important;
        min-height: 500px;
        display: block;
        border: 0;
    }
</style>

<?php require_once "footer.php"; ?>