<?php
$page_title = "Layanan Publik";
require_once "header.php";

$page_meta_desc = "Daftar layanan publik dan administrasi kependudukan di " . $site_title;
?>
<!-- Modern Hero Header -->
<div class="position-relative overflow-hidden mb-5"
    style="background: linear-gradient(135deg, var(--primary-dark), var(--primary-color)); padding: 120px 0 80px;">
    <div class="position-absolute top-0 start-0 w-100 h-100 bg-pattern opacity-10"></div>
    <div class="container position-relative z-1 text-center text-white mt-4">
        <span class="badge bg-white text-primary rounded-pill px-3 py-2 fw-medium mb-3 shadow-sm">
            <i class="fas fa-server me-1"></i> Pelayanan Publik
        </span>
        <h1 class="display-4 fw-bold brand-font mb-3 text-shadow">Layanan Terpadu Desa</h1>
        <p class="lead fw-light opacity-75 mx-auto" style="max-width: 600px;">
            Akses informasi persyaratan dan tata cara administrasi dengan mudah, cepat, dan transparan.
        </p>
    </div>
</div>

<div class="container mb-5 pb-5">
    <div class="row g-4 justify-content-center">
        <?php
        $stmt = $conn->query("SELECT * FROM layanan ORDER BY id DESC");
        while ($row = $stmt->fetch_assoc()):
            ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card card-modern h-100 p-4 text-center">
                    <div class="card-body">
                        <div class="icon-box mx-auto">
                            <i class="fas fa-file-signature fa-2x"></i>
                        </div>
                        <h4 class="card-title fw-bold mb-3 brand-font text-dark">
                            <?= htmlspecialchars($row['nama']) ?>
                        </h4>
                        <p class="card-text text-muted mb-4">
                            <?= htmlspecialchars(substr($row['deskripsi'], 0, 100)) ?>...
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-0 pb-3">
                        <a href="<?= $domain ?>/layanan/<?= $row['slug'] ?>"
                            class="btn btn-modern btn-outline-modern w-100">Detail Persyaratan</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
<?php require_once "footer.php"; ?>