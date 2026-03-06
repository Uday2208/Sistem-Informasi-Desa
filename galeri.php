<?php
$page_title = "Galeri Desa";
require_once "header.php";

$page_meta_desc = "Kumpulan foto kegiatan dan dokumentasi acara di " . $site_title;
?>
<!-- Modern Hero Header -->
<div class="position-relative overflow-hidden mb-5"
    style="background: linear-gradient(135deg, var(--primary-dark), var(--primary-color)); padding: 120px 0 80px;">
    <div class="position-absolute top-0 start-0 w-100 h-100 bg-pattern opacity-10"></div>
    <div class="container position-relative z-1 text-center text-white mt-4">
        <span class="badge bg-white text-primary rounded-pill px-3 py-2 fw-medium mb-3 shadow-sm">
            <i class="far fa-images me-1"></i> Dokumentasi Visual
        </span>
        <h1 class="display-4 fw-bold brand-font mb-3 text-shadow">Galeri Kegiatan Desa</h1>
        <p class="lead fw-light opacity-75 mx-auto" style="max-width: 600px;">
            Momen-momen penting dari berbagai kegiatan pelayanan, pembangunan, dan kemasyarakatan.
        </p>
    </div>
</div>

<div class="container mb-5 pb-5">
    <div class="row g-4 justify-content-center">
        <?php
        $stmt = $conn->query("SELECT * FROM galeri ORDER BY id DESC");
        while ($row = $stmt->fetch_assoc()):
            $img_src = filter_var($row['image'], FILTER_VALIDATE_URL) ? $row['image'] : $domain . '/uploads/' . $row['image'];
            ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card card-modern border-0 p-1 bg-white h-100">
                    <div class="position-relative overflow-hidden rounded-4 h-100">
                        <img src="<?= htmlspecialchars($img_src) ?>" class="w-100 h-100 card-img-modern"
                            style="object-fit:cover; min-height: 250px;" alt="<?= htmlspecialchars($row['title']) ?>"
                            loading="lazy">
                        <div class="position-absolute bottom-0 start-0 w-100 p-4 text-white"
                            style="background: linear-gradient(transparent, rgba(15,23,42,0.95));">
                            <h5 class="fw-bold brand-font mb-1 line-clamp-2"><?= htmlspecialchars($row['title']) ?></h5>
                            <small class="text-white-50"><i class="far fa-calendar-alt me-1"></i>
                                <?= date("d M Y", strtotime($row['created_at'])) ?></small>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
<?php require_once "footer.php"; ?>