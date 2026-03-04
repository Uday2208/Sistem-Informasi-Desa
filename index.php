<?php
$page_title = "Beranda";
require_once "header.php";

$extra_structured_data = '
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "' . htmlspecialchars($site_title) . '",
  "image": "' . $domain . '/uploads/' . $logo . '",
  "url": "' . $domain . '"
}
</script>
';
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="display-4 fw-bold">Selamat Datang di
                <?= htmlspecialchars($site_title) ?>
            </h1>
            <p class="lead text-muted">
                <?= htmlspecialchars($global_meta_desc) ?>
            </p>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <h2 class="mb-4">Berita Terbaru</h2>
            <div class="row">
                <?php
                $stmt = $conn->query("SELECT * FROM berita ORDER BY id DESC LIMIT 3");
                while ($row = $stmt->fetch_assoc()):
                    ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm border-0">
                            <?php if ($row['meta_image']): ?>
                                <img src="<?= $domain ?>/uploads/<?= htmlspecialchars($row['meta_image']) ?>"
                                    class="card-img-top" alt="<?= htmlspecialchars($row['title']) ?>" loading="lazy"
                                    style="height:200px; object-fit:cover;">
                            <?php else: ?>
                                <div class="bg-secondary text-white d-flex align-items-center justify-content-center"
                                    style="height:200px;">No Image</div>
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?= htmlspecialchars($row['title']) ?>
                                </h5>
                                <p class="card-text text-muted">
                                    <?= htmlspecialchars(substr(strip_tags($row['content']), 0, 100)) ?>...
                                </p>
                            </div>
                            <div class="card-footer bg-white border-0 pb-3">
                                <a href="<?= $domain ?>/berita/<?= $row['slug'] ?>"
                                    class="btn btn-outline-primary w-100">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>
<?php require_once "footer.php"; ?>