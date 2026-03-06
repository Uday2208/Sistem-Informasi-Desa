<?php
require_once "config/database.php";

$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
$stmt = $conn->prepare("SELECT * FROM layanan WHERE slug = ?");
$stmt->bind_param("s", $slug);
$stmt->execute();
$layanan = $stmt->get_result()->fetch_assoc();

if (!$layanan) {
    header("HTTP/1.0 404 Not Found");
    echo "<div style='text-align:center; padding: 50px;'><h1>404 Not Found</h1><a href='" . $domain . "'>Kembali</a></div>";
    exit;
}

$page_title = "Layanan: " . $layanan['nama'];
$page_meta_desc = htmlspecialchars(substr($layanan['deskripsi'], 0, 150));
require_once "header.php";
?>
<div class="container mt-5 mb-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $domain ?>/">Beranda</a></li>
            <li class="breadcrumb-item"><a href="<?= $domain ?>/layanan">Layanan</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                <?= htmlspecialchars($layanan['nama']) ?>
            </li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-md-9 bg-white p-5 shadow-sm border rounded-4">
            <div class="text-center mb-5">
                <div class="d-inline-block bg-primary text-white p-3 rounded-circle mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                        class="bi bi-file-earmark-text" viewBox="0 0 16 16">
                        <path
                            d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z" />
                        <path
                            d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2.5a1 1 0 0 0 1 1H13v9a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                    </svg>
                </div>
                <h1 class="fw-bold text-dark">
                    <?= htmlspecialchars($layanan['nama']) ?>
                </h1>
                <p class="text-muted">Prosedur dan Persyaratan Administrasi Pemerintahan Desa</p>
            </div>

            <div class="alert alert-info border-0 shadow-sm p-4 mb-4">
                <h5 class="fw-bold"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-info-circle-fill me-2" viewBox="0 0 16 16">
                        <path
                            d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2" />
                    </svg> Deskripsi Layanan</h5>
                <hr>
                <p class="mb-0 lh-lg fs-6">
                    <?= nl2br(htmlspecialchars($layanan['deskripsi'])) ?>
                </p>
            </div>

            <h4 class="fw-bold mt-5 mb-3">Persyaratan Umum</h4>
            <ul class="list-group list-group-flush mb-4 fs-6">
                <li class="list-group-item px-0 py-3"><i class="fw-bold text-primary me-2">1.</i> Membawa KTP (Kartu
                    Tanda Penduduk) asli dan fotokopi 1 lembar.</li>
                <li class="list-group-item px-0 py-3"><i class="fw-bold text-primary me-2">2.</i> Membawa KK (Kartu
                    Keluarga) asli dan fotokopi 1 lembar.</li>
                <li class="list-group-item px-0 py-3"><i class="fw-bold text-primary me-2">3.</i> Membawa Surat
                    Pengantar dari RT/RW setempat.</li>
                <li class="list-group-item px-0 py-3"><i class="fw-bold text-primary me-2">4.</i> Dokumen khusus lainnya
                    sesuai dengan permohonan layanan.</li>
            </ul>

            <div class="p-4 bg-light rounded-3 mt-5 text-center border">
                <p class="mb-2">Jam pelayanan operasional desa Senin-Jumat dari jam 08:00 - 15:00. Tidak dipungut biaya
                    (Gratis).</p>
            </div>
        </div>
    </div>
</div>
<?php require_once "footer.php"; ?>