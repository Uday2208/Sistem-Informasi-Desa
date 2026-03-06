<?php
$page_title = "Berita Desa";
require_once "header.php";
?>
<!-- Modern Hero Header -->
<div class="position-relative overflow-hidden mb-5"
    style="background: linear-gradient(135deg, var(--primary-dark), var(--primary-color)); padding: 120px 0 80px;">
    <div class="position-absolute top-0 start-0 w-100 h-100 bg-pattern opacity-10"></div>
    <div class="container position-relative z-1 text-center text-white mt-4">
        <span class="badge bg-white text-primary rounded-pill px-3 py-2 fw-medium mb-3 shadow-sm">
            <i class="fas fa-newspaper me-1"></i> Informasi Desa
        </span>
        <h1 class="display-4 fw-bold brand-font mb-3 text-shadow">Kabar & Berita Terkini</h1>
        <p class="lead fw-light opacity-75 mx-auto" style="max-width: 600px;">
            Dapatkan informasi terbaru seputar pembangunan, kegiatan masyarakat, dan pengumuman resmi.
        </p>
    </div>
</div>

<div class="container mb-5 pb-5">
    <div class="row g-4 justify-content-center">
        <?php
        $stmt = $conn->query("SELECT * FROM berita ORDER BY id DESC");
        while ($row = $stmt->fetch_assoc()):
            $img_src = !empty($row['meta_image']) && filter_var($row['meta_image'], FILTER_VALIDATE_URL) ? $row['meta_image'] : (!empty($row['meta_image']) ? $domain . '/uploads/' . $row['meta_image'] : '');
            ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card card-modern h-100">
                    <?php if ($img_src): ?>
                        <div class="overflow-hidden">
                            <img src="<?= htmlspecialchars($img_src) ?>" class="card-img-top card-img-modern"
                                alt="<?= htmlspecialchars($row['title']) ?>" loading="lazy"
                                style="height:220px; object-fit:cover;">
                        </div>
                    <?php else: ?>
                        <div class="bg-light text-muted d-flex align-items-center justify-content-center card-img-modern"
                            style="height:220px;"><i class="far fa-image fa-3x opacity-25"></i></div>
                    <?php endif; ?>
                    <div class="card-body p-4">
                        <div class="mb-3 d-flex align-items-center text-muted small fw-medium">
                            <i class="far fa-calendar-alt text-primary me-2"></i>
                            <?= date("d M Y", strtotime($row['created_at'])) ?>
                        </div>
                        <h5 class="card-title fw-bold brand-font mb-3 line-clamp-2">
                            <?= htmlspecialchars($row['title']) ?>
                        </h5>
                        <p class="card-text text-muted mb-0">
                            <?= htmlspecialchars(substr(strip_tags($row['content']), 0, 100)) ?>...
                        </p>
                    </div>
                    <div class="card-footer bg-white border-0 p-4 pt-0">
                        <a href="<?= $domain ?>/berita/<?= $row['slug'] ?>"
                            class="text-primary text-decoration-none fw-bold">Baca Selengkapnya &rarr;</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>