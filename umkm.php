<?php
$page_title = "Data UMKM";
require_once "header.php";

$page_meta_desc = "Katalog Usaha Mikro Kecil dan Menengah (UMKM) unggulan dari " . $site_title;
?>
<!-- Modern Hero Header -->
<div class="position-relative overflow-hidden mb-5"
    style="background: linear-gradient(135deg, var(--primary-dark), var(--primary-color)); padding: 120px 0 80px;">
    <div class="position-absolute top-0 start-0 w-100 h-100 bg-pattern opacity-10"></div>
    <div class="container position-relative z-1 text-center text-white mt-4">
        <span class="badge bg-white text-primary rounded-pill px-3 py-2 fw-medium mb-3 shadow-sm">
            <i class="fas fa-store me-1"></i> Ekonomi Kreatif
        </span>
        <h1 class="display-4 fw-bold brand-font mb-3 text-shadow">Katalog UMKM Desa</h1>
        <p class="lead fw-light opacity-75 mx-auto" style="max-width: 600px;">
            Mendukung pertumbuhan ekonomi lokal melalui produk-produk unggulan karya warga desa.
        </p>
    </div>
</div>

<div class="container mb-5 pb-5">
    <div class="row g-4 justify-content-center">
        <?php
        $stmt = $conn->query("SELECT * FROM umkm ORDER BY id DESC");
        while ($row = $stmt->fetch_assoc()):
            $img_src = "https://picsum.photos/seed/" . md5($row['slug']) . "/800/600";
            ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card card-modern h-100">
                    <div class="overflow-hidden">
                        <img src="<?= htmlspecialchars($img_src) ?>" class="card-img-top card-img-modern"
                            alt="<?= htmlspecialchars($row['nama']) ?>" loading="lazy"
                            style="height:240px; object-fit:cover;">
                    </div>
                    <div class="card-body p-4">
                        <h5 class="card-title text-dark fw-bold brand-font mb-3">
                            <?= htmlspecialchars($row['nama']) ?>
                        </h5>
                        <p class="card-text text-muted mb-0">
                            <?= htmlspecialchars(substr($row['deskripsi'], 0, 90)) ?>...
                        </p>
                    </div>
                    <div class="card-footer bg-white border-0 p-4 pt-0">
                        <a href="<?= $domain ?>/umkm/<?= $row['slug'] ?>"
                            class="text-primary text-decoration-none fw-semibold">Detail Usaha <i
                                class="fas fa-chevron-right ms-1 fs-6"></i></a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
<?php require_once "footer.php"; ?>