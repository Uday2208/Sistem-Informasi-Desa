<?php require_once "header.php"; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0 text-dark">Dashboard Administrator</h2>
        <p class="text-muted mb-0">Ringkasan informasi sistem dan data desa terpadu</p>
    </div>
    <div class="d-none d-sm-block">
        <span class="badge bg-white text-dark shadow-sm px-3 py-2 rounded-pill border">
            <i class="far fa-calendar-alt text-primary me-2"></i>
            <?= date('d M Y') ?>
        </span>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Card Berita -->
    <div class="col-xl-3 col-md-6">
        <div class="card dash-card bg-gradient-primary h-100">
            <div class="card-body">
                <i class="far fa-newspaper card-icon"></i>
                <h6 class="text-uppercase fw-semibold mb-1 opacity-75">Total Berita</h6>
                <h2 class="card-title fw-bold mb-0 mt-2">
                    <?php
                    $res = $conn->query("SELECT COUNT(*) as total FROM berita");
                    echo number_format($res->fetch_assoc()['total']);
                    ?>
                </h2>
            </div>
            <div class="card-footer bg-transparent border-0 pt-0 pb-3">
                <a href="berita.php" class="text-white text-decoration-none small fw-medium">Lihat Detail <i
                        class="fas fa-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>

    <!-- Card Layanan -->
    <div class="col-xl-3 col-md-6">
        <div class="card dash-card bg-gradient-success h-100">
            <div class="card-body">
                <i class="fas fa-concierge-bell card-icon"></i>
                <h6 class="text-uppercase fw-semibold mb-1 opacity-75">Total Layanan</h6>
                <h2 class="card-title fw-bold mb-0 mt-2">
                    <?php
                    $res = $conn->query("SELECT COUNT(*) as total FROM layanan");
                    echo number_format($res->fetch_assoc()['total']);
                    ?>
                </h2>
            </div>
            <div class="card-footer bg-transparent border-0 pt-0 pb-3">
                <a href="layanan.php" class="text-white text-decoration-none small fw-medium">Lihat Detail <i
                        class="fas fa-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>

    <!-- Card UMKM -->
    <div class="col-xl-3 col-md-6">
        <div class="card dash-card bg-gradient-warning h-100">
            <div class="card-body">
                <i class="fas fa-store card-icon"></i>
                <h6 class="text-uppercase fw-semibold mb-1 opacity-75 text-dark">Katalog UMKM</h6>
                <h2 class="card-title fw-bold mb-0 mt-2 text-dark">
                    <?php
                    $res = $conn->query("SELECT COUNT(*) as total FROM umkm");
                    echo number_format($res->fetch_assoc()['total']);
                    ?>
                </h2>
            </div>
            <div class="card-footer bg-transparent border-0 pt-0 pb-3">
                <a href="umkm.php" class="text-dark text-decoration-none small fw-medium">Lihat Detail <i
                        class="fas fa-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>

    <!-- Card Pegawai -->
    <div class="col-xl-3 col-md-6">
        <div class="card dash-card bg-gradient-danger h-100">
            <div class="card-body">
                <i class="fas fa-users card-icon"></i>
                <h6 class="text-uppercase fw-semibold mb-1 opacity-75">Data Pegawai</h6>
                <h2 class="card-title fw-bold mb-0 mt-2">
                    <?php
                    $res = $conn->query("SELECT COUNT(*) as total FROM pegawai");
                    echo number_format($res->fetch_assoc()['total']);
                    ?>
                </h2>
            </div>
            <div class="card-footer bg-transparent border-0 pt-0 pb-3">
                <a href="pegawai.php" class="text-white text-decoration-none small fw-medium">Lihat Detail <i
                        class="fas fa-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>
</div>

<?php require_once "footer.php"; ?>