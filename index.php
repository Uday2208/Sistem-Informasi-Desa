<?php
$page_title = "Beranda";
require_once "header.php";
?>
<!-- Dynamic Running Text -->
<?php
$running_texts = [];

// Get from pengumuman
$resText = $conn->query("SELECT * FROM pengumuman WHERE is_active=1 ORDER BY id DESC");
if ($resText) {
    while ($txt = $resText->fetch_assoc()) {
        $running_texts[] = [
            'teks' => $txt['teks'],
            'link' => null
        ];
    }
}

// Get from berita (is_running_text = 1)
$resBeritaText = $conn->query("SELECT title, slug FROM berita WHERE is_running_text=1 ORDER BY id DESC");
if ($resBeritaText) {
    while ($bText = $resBeritaText->fetch_assoc()) {
        $running_texts[] = [
            'teks' => "BERITA TERBARU: " . $bText['title'],
            'link' => $domain . '/berita/' . $bText['slug']
        ];
    }
}

if (!empty($running_texts)):
    ?>
    <div class="bg-warning text-dark py-2 overflow-hidden shadow-sm d-flex align-items-center">
        <div class="container-fluid d-flex">
            <span class="badge bg-danger ms-3 me-3 d-flex align-items-center">INFO TERKINI</span>
            <marquee onmouseover="this.stop();" onmouseout="this.start();" class="flex-grow-1 fw-bold">
                <?php foreach ($running_texts as $item): ?>
                    <span class="me-5">
                        &bull;
                        <?php if ($item['link']): ?>
                            <a href="<?= htmlspecialchars($item['link']) ?>" class="text-dark text-decoration-none hover-primary">
                                <?= htmlspecialchars($item['teks']) ?> <i class="fas fa-external-link-alt ms-1 text-muted"
                                    style="font-size: 0.8em;"></i>
                            </a>
                        <?php else: ?>
                            <?= htmlspecialchars($item['teks']) ?>
                        <?php endif; ?>
                    </span>
                <?php endforeach; ?>
            </marquee>
        </div>
    </div>
<?php endif; ?>

<!-- Dynamic Hero Carousel -->
<div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" style="margin-top: -80px;">
    <div class="carousel-inner">
        <?php
        $resBanner = $conn->query("SELECT * FROM banners ORDER BY urutan ASC, id DESC");
        $i = 0;
        while ($ban = $resBanner->fetch_assoc()):
            $ban_img = filter_var($ban['image'], FILTER_VALIDATE_URL) ? $ban['image'] : $domain . '/uploads/' . $ban['image'];
            ?>
            <div class="carousel-item <?= $i == 0 ? 'active' : '' ?>">
                <div class="d-flex align-items-center justify-content-center"
                    style="height: 75vh; min-height: 550px; max-height: 650px; background-image: url('<?= htmlspecialchars($ban_img) ?>'); background-size: cover; background-position: center; position: relative;">

                    <!-- Overlay Matrix -->
                    <div
                        style="position: absolute; top:0; left:0; width:100%; height:100%; background: linear-gradient(90deg, rgba(15,23,42,0.85) 0%, rgba(15,23,42,0.3) 100%);">
                    </div>
                    <div
                        style="position: absolute; bottom:0; left:0; width:100%; height:150px; background: linear-gradient(to top, var(--bg-light) 0%, transparent 100%);">
                    </div>

                    <div class="container position-relative text-white text-center text-lg-start mt-4">
                        <div class="row align-items-center">
                            <div class="col-lg-8 col-xl-7">
                                <span
                                    class="badge bg-primary bg-opacity-75 border border-primary border-opacity-50 rounded-pill mb-3 px-3 py-2 fw-medium text-uppercase tracking-wider shadow-sm"
                                    style="backdrop-filter: blur(5px);">
                                    <i class="fas fa-star text-warning me-1"></i> Selamat Datang di Portal Resmi
                                </span>
                                <h1 class="display-4 fw-bold mb-3 brand-font text-white lh-sm"
                                    style="letter-spacing: -1px; text-shadow: 0 4px 15px rgba(0,0,0,0.4);">
                                    <?= htmlspecialchars($ban['title']) ?></h1>
                                <p class="lead mb-4 fs-5 text-light fw-light opacity-75"
                                    style="max-width: 600px; text-shadow: 0 2px 10px rgba(0,0,0,0.5);">
                                    <?= htmlspecialchars($ban['subtitle']) ?>
                                </p>
                                <?php if ($ban['link']): ?>
                                    <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start">
                                        <a href="<?= htmlspecialchars($ban['link']) ?>"
                                            class="btn btn-modern btn-primary-modern px-5 py-2 shadow-lg">Jelajahi Sekarang <i
                                                class="fas fa-arrow-right ms-2"></i></a>
                                        <a href="#layanan" class="btn btn-modern btn-outline-light px-5 py-2"
                                            style="backdrop-filter: blur(5px);">Layanan Kami</a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $i++; endwhile; ?>
    </div>
    <?php if ($i > 1): ?>
        <button class="carousel-control-prev w-auto ps-4" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon rounded-circle bg-dark bg-opacity-50 p-3" aria-hidden="true"
                style="width: 3rem; height: 3rem;"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next w-auto pe-4" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon rounded-circle bg-dark bg-opacity-50 p-3" aria-hidden="true"
                style="width: 3rem; height: 3rem;"></span>
            <span class="visually-hidden">Next</span>
        </button>
    <?php endif; ?>
</div>

<!-- Layanan Publik Section -->
<section id="layanan" class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5 pb-3">
            <span class="text-primary fw-bold text-uppercase tracking-wider small mb-2 d-block">Layanan Terpadu</span>
            <h2 class="fw-bold brand-font display-6 mb-3">Layanan Publik Digital</h2>
            <p class="text-muted lead mx-auto" style="max-width: 600px;">Kemudahan akses layanan administrasi masyarakat
                desa secara cepat dan transparan.</p>
        </div>
        <div class="row g-4">
            <?php
            $stmt = $conn->query("SELECT * FROM layanan ORDER BY id DESC LIMIT 3");
            while ($row = $stmt->fetch_assoc()):
                ?>
                <div class="col-lg-4 col-md-6">
                    <div class="card card-modern h-100 p-4 text-center">
                        <div class="card-body">
                            <div class="icon-box mx-auto">
                                <i class="fas fa-file-signature fa-2x"></i>
                            </div>
                            <h4 class="card-title fw-bold mb-3 brand-font"><?= htmlspecialchars($row['nama']) ?></h4>
                            <p class="card-text text-muted mb-4">
                                <?= htmlspecialchars(substr($row['deskripsi'], 0, 100)) ?>...
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-0 pb-3">
                            <a href="<?= $domain ?>/layanan/<?= $row['slug'] ?>"
                                class="btn btn-outline-modern btn-modern w-100">Detail Persyaratan</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="text-center mt-5">
            <a href="<?= $domain ?>/layanan" class="btn btn-modern btn-primary-modern px-5">Lihat Semua Layanan <i
                    class="fas fa-arrow-right ms-2"></i></a>
        </div>
    </div>
</section>

<!-- UMKM Section -->
<section class="section-padding" style="background-color: var(--bg-light);">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-5 flex-wrap gap-3">
            <div>
                <span class="text-primary fw-bold text-uppercase tracking-wider small mb-2 d-block">Ekonomi
                    Kreatif</span>
                <h2 class="fw-bold brand-font display-6 mb-0 text-dark">Produk UMKM Unggulan</h2>
            </div>
            <a href="<?= $domain ?>/umkm" class="btn btn-modern btn-outline-modern px-4 d-none d-md-inline-block">Lihat
                Katalog <i class="fas fa-shopping-bag ms-2"></i></a>
        </div>
        <div class="row g-4">
            <?php
            $stmt = $conn->query("SELECT * FROM umkm ORDER BY id DESC LIMIT 3");
            while ($row = $stmt->fetch_assoc()):
                ?>
                <div class="col-lg-4 col-md-6">
                    <div class="card card-modern h-100">
                        <div class="overflow-hidden">
                            <img src="https://picsum.photos/seed/<?= $row['slug'] ?>/800/600"
                                class="card-img-top card-img-modern" alt="<?= htmlspecialchars($row['nama']) ?>"
                                loading="lazy" style="height:240px; object-fit:cover;">
                        </div>
                        <div class="card-body p-4">
                            <h5 class="card-title text-dark fw-bold brand-font mb-3"><?= htmlspecialchars($row['nama']) ?>
                            </h5>
                            <p class="card-text text-muted mb-0">
                                <?= htmlspecialchars(substr($row['deskripsi'], 0, 90)) ?>...
                            </p>
                        </div>
                        <div class="card-footer bg-white border-0 p-4 pt-0">
                            <a href="<?= $domain ?>/umkm/<?= $row['slug'] ?>"
                                class="text-primary text-decoration-none fw-semibold">Beli & Detail Produk <i
                                    class="fas fa-chevron-right ms-1 fs-6"></i></a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="text-center mt-4 d-md-none">
            <a href="<?= $domain ?>/umkm" class="btn btn-modern btn-primary-modern w-100">Lihat Katalog</a>
        </div>
    </div>
</section>

<!-- Berita Terkini -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-5 flex-wrap gap-3">
            <div>
                <span class="text-primary fw-bold text-uppercase tracking-wider small mb-2 d-block">Informasi
                    Publik</span>
                <h2 class="fw-bold brand-font display-6 mb-0">Kabar & Berita Terkini</h2>
            </div>
            <a href="<?= $domain ?>/berita"
                class="btn btn-modern btn-outline-modern px-4 d-none d-md-inline-block">Semua Berita <i
                    class="fas fa-newspaper ms-2"></i></a>
        </div>
        <div class="row g-4">
            <?php
            $stmt = $conn->query("SELECT * FROM berita ORDER BY id DESC LIMIT 3");
            while ($row = $stmt->fetch_assoc()):
                $img_src = !empty($row['meta_image']) && filter_var($row['meta_image'], FILTER_VALIDATE_URL) ? $row['meta_image'] : (!empty($row['meta_image']) ? $domain . '/uploads/' . $row['meta_image'] : '');
                ?>
                <div class="col-lg-4 col-md-6">
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
        <div class="text-center mt-4 d-md-none">
            <a href="<?= $domain ?>/berita" class="btn btn-modern btn-primary-modern w-100">Semua Berita</a>
        </div>
    </div>
</section>

<!-- Galeri Desa -->
<section class="section-padding" style="background-color: var(--bg-light);">
    <div class="container">
        <div class="text-center mb-5 pb-2">
            <span class="text-primary fw-bold text-uppercase tracking-wider small mb-2 d-block">Dokumentasi</span>
            <h2 class="fw-bold brand-font display-6">Galeri Kegiatan</h2>
        </div>
        <div class="row g-3">
            <?php
            $stmt = $conn->query("SELECT * FROM galeri ORDER BY id DESC LIMIT 4");
            while ($row = $stmt->fetch_assoc()):
                $img_src = filter_var($row['image'], FILTER_VALIDATE_URL) ? $row['image'] : $domain . '/uploads/' . $row['image'];
                ?>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="card card-modern border-0 p-1 bg-white">
                        <div class="position-relative overflow-hidden rounded-4" style="height: 200px;">
                            <img src="<?= htmlspecialchars($img_src) ?>" class="w-100 h-100 card-img-modern"
                                style="object-fit:cover;" alt="<?= htmlspecialchars($row['title']) ?>" loading="lazy">
                            <div class="position-absolute bottom-0 start-0 w-100 p-3 text-white"
                                style="background: linear-gradient(transparent, rgba(15,23,42,0.9));">
                                <span
                                    class="fw-bold brand-font d-block text-truncate"><?= htmlspecialchars($row['title']) ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="text-center mt-5">
            <a href="<?= $domain ?>/galeri" class="btn btn-modern btn-primary-modern px-5">Jelajahi Galeri Foto <i
                    class="fas fa-images ms-2"></i></a>
        </div>
    </div>
</section>

<?php require_once "footer.php"; ?>