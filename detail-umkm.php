<?php
require_once "config/database.php";

$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
$stmt = $conn->prepare("SELECT * FROM umkm WHERE slug = ?");
$stmt->bind_param("s", $slug);
$stmt->execute();
$umkm = $stmt->get_result()->fetch_assoc();

if (!$umkm) {
    header("HTTP/1.0 404 Not Found");
    echo "<div style='text-align:center; padding: 50px;'><h1>404 Not Found</h1><a href='" . $domain . "'>Kembali</a></div>";
    exit;
}

$page_title = $umkm['nama'];
$page_meta_desc = htmlspecialchars(substr($umkm['deskripsi'], 0, 150));
require_once "header.php";
$img_src = "https://picsum.photos/seed/" . md5($umkm['slug']) . "/800/600";
?>
<div class="container mt-5 mb-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $domain ?>/">Beranda</a></li>
            <li class="breadcrumb-item"><a href="<?= $domain ?>/umkm">UMKM</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                <?= htmlspecialchars($umkm['nama']) ?>
            </li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-8 offset-md-2 p-0 rounded-4 overflow-hidden shadow">
            <img src="<?= htmlspecialchars($img_src) ?>" class="img-fluid w-100"
                style="height: 400px; object-fit: cover;" alt="<?= htmlspecialchars($umkm['nama']) ?>">
            <div class="bg-white p-5">
                <h1 class="fw-bold text-primary mb-3">
                    <?= htmlspecialchars($umkm['nama']) ?>
                </h1>
                <div class="badge bg-success mb-4 fs-6 py-2 px-3">Produk Unggulan</div>
                <h4 class="fw-bold mb-3">Deskripsi Usaha / Produk</h4>
                <p class="lh-lg fs-5 text-muted">
                    <?= nl2br(htmlspecialchars($umkm['deskripsi'])) ?>
                </p>

                <div class="mt-5 p-4 bg-light rounded-3 border">
                    <h5 class="fw-bold mb-3">Tertarik dengan Produk ini?</h5>
                    <p>Silakan hubungi pengelola BUMDes atau datang langsung ke gerai UMKM Desa kami untuk pembelian
                        atau kerjasama bisnis.</p>
                    <a href="https://wa.me/6281234567890?text=Halo%20saya%20tertarik%20dengan%20produk%20UMKM%20<?= urlencode($umkm['nama']) ?>"
                        target="_blank" class="btn btn-success btn-lg rounded-pill px-4 fw-bold">
                        Hubungi via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once "footer.php"; ?>