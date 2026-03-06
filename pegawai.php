<?php
$page_title = "Aparatur Desa";
require_once "header.php";

$page_meta_desc = "Susunan organisasi dan tata kerja pemerintahan " . $site_title;
?>
<!-- Modern Hero Header -->
<div class="position-relative overflow-hidden mb-5"
    style="background: linear-gradient(135deg, rgba(15,23,42,0.95), rgba(2,132,199,0.9)), url('https://picsum.photos/seed/kantor/1920/1080') no-repeat center center/cover; padding: 120px 0 80px;">
    <div class="position-absolute top-0 start-0 w-100 h-100 bg-pattern opacity-10"></div>
    <div class="container position-relative z-1 text-center text-white mt-4">
        <span class="badge bg-white text-primary rounded-pill px-3 py-2 fw-medium mb-3 shadow-sm">
            <i class="fas fa-users-cog me-1"></i> Pemerintahan
        </span>
        <h1 class="display-4 fw-bold brand-font mb-3 text-shadow">Aparatur Pemerintahan Desa</h1>
        <p class="lead fw-light opacity-75 mx-auto" style="max-width: 600px;">
            Pengabdian Mulus, Pelayanan Tulus, Bersama Menciptakan Desa yang Lebih Maju.
        </p>
    </div>
</div>

<div class="container mb-5 pb-5">
    <div class="row g-4 justify-content-center">
        <?php
        $stmt = $conn->query("SELECT * FROM pegawai ORDER BY urutan ASC, jabatan ASC");
        while ($row = $stmt->fetch_assoc()):
            $img_src = filter_var($row['foto'], FILTER_VALIDATE_URL) ? $row['foto'] : $domain . '/uploads/' . $row['foto'];
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card card-modern h-100 text-center team-card">
                    <div class="overflow-hidden" style="border-radius: 20px 20px 0 0;">
                        <img src="<?= htmlspecialchars($img_src) ?>" class="card-img-modern w-100"
                            style="height: 320px; object-fit: cover; object-position: top;"
                            alt="<?= htmlspecialchars($row['nama']) ?>">
                    </div>
                    <div class="card-body p-4 bg-white" style="position: relative; border-radius: 0 0 20px 20px;">
                        <div class="d-inline-block bg-primary text-white rounded-pill px-4 py-2 small fw-bold mb-3 shadow-sm"
                            style="transform: translateY(-35px); border: 3px solid white;">
                            <?= htmlspecialchars($row['jabatan']) ?>
                        </div>
                        <h5 class="fw-bold text-dark mb-1 brand-font" style="margin-top: -20px;">
                            <?= htmlspecialchars($row['nama']) ?>
                        </h5>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php require_once "footer.php"; ?>