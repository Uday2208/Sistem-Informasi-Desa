<?php
$page_title = "Profil Desa";
require_once "header.php";

$page_meta_desc = "Informasi lengkap identitas, sejarah, visi misi " . $site_title;
?>

<style>
    .nav-profil-pills {
        background: #fff;
        padding: 10px;
        border-radius: 50px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        display: inline-flex;
        margin-bottom: 30px;
    }

    .nav-profil-pills .nav-link {
        border-radius: 40px;
        padding: 12px 30px;
        font-weight: 600;
        color: var(--text-muted);
        transition: all 0.3s ease;
    }

    .nav-profil-pills .nav-link:hover {
        color: var(--primary-color);
    }

    .nav-profil-pills .nav-link.active {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: #fff;
        box-shadow: 0 4px 15px rgba(14, 165, 233, 0.3);
    }

    .logo-container {
        position: relative;
        padding: 20px;
        background: #fff;
        border-radius: 50%;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
        display: inline-block;
        margin-bottom: -60px;
        z-index: 10;
        border: 5px solid #f8fafc;
        transform: translateY(-80px);
    }

    .logo-container img {
        width: 120px;
        height: 120px;
        object-fit: contain;
    }
</style>

<!-- Modern Hero Header -->
<div class="position-relative overflow-hidden mb-5"
    style="background: linear-gradient(135deg, var(--primary-dark), var(--primary-color)); padding: 120px 0 120px;">
    <div class="position-absolute top-0 start-0 w-100 h-100 bg-pattern opacity-10"></div>
    <div class="container position-relative z-1 text-center text-white mt-4">
        <span class="badge bg-white text-primary rounded-pill px-3 py-2 fw-medium mb-3 shadow-sm">
            <i class="fas fa-info-circle me-1"></i> Profil Desa
        </span>
        <h1 class="display-4 fw-bold brand-font mb-3 text-shadow">Identitas & Sejarah</h1>
        <p class="lead fw-light opacity-75 mx-auto" style="max-width: 600px;">
            Mengenal lebih dekat sejarah, visi, dan misi dari <?= htmlspecialchars($site_title) ?>
        </p>
    </div>
</div>

<div class="container text-center">
    <div class="logo-container">
        <img src="<?= $domain ?>/uploads/<?= htmlspecialchars($logo) ?>" alt="Logo Desa">
    </div>
</div>

<div class="container mb-5 pt-5 pb-5">
    <div class="row align-items-center justify-content-center">
        <div class="col-lg-10 text-center">

            <!-- Navigation Tabs -->
            <ul class="nav nav-pills nav-profil-pills justify-content-center" id="profil-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="sejarah-tab" data-bs-toggle="pill" data-bs-target="#sejarah"
                        type="button" role="tab" aria-selected="true">
                        <i class="fas fa-history me-2"></i> Sejarah
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="visi-tab" data-bs-toggle="pill" data-bs-target="#visi" type="button"
                        role="tab" aria-selected="false">
                        <i class="fas fa-eye me-2"></i> Visi
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="misi-tab" data-bs-toggle="pill" data-bs-target="#misi" type="button"
                        role="tab" aria-selected="false">
                        <i class="fas fa-bullseye me-2"></i> Misi
                    </button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content text-start" id="profil-tabContent">

                <!-- Tab Sejarah -->
                <div class="tab-pane fade show active" id="sejarah" role="tabpanel" aria-labelledby="sejarah-tab">
                    <div class="content-card">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                                <i class="fas fa-landmark text-primary fs-3"></i>
                            </div>
                            <h2 class="fw-bold text-dark mb-0">Sejarah Singkat</h2>
                        </div>
                        <div class="content-body">
                            <?= get_setting($conn, 'sejarah') ?>
                        </div>
                    </div>
                </div>

                <!-- Tab Visi -->
                <div class="tab-pane fade" id="visi" role="tabpanel" aria-labelledby="visi-tab">
                    <div class="content-card border-top border-4 border-success">
                        <div class="d-flex align-items-center mb-4 text-center justify-content-center flex-column">
                            <div class="bg-success bg-opacity-10 p-4 rounded-circle mb-3">
                                <i class="fas fa-eye text-success fs-1"></i>
                            </div>
                            <h2 class="fw-bold text-success mb-0">Visi Kami</h2>
                        </div>
                        <div class="content-body text-center fs-3 fst-italic">
                            " <?= strip_tags(get_setting($conn, 'visi')) ?> "
                        </div>
                    </div>
                </div>

                <!-- Tab Misi -->
                <div class="tab-pane fade" id="misi" role="tabpanel" aria-labelledby="misi-tab">
                    <div class="content-card border-top border-4 border-primary">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                                <i class="fas fa-tasks text-primary fs-3"></i>
                            </div>
                            <h2 class="fw-bold text-primary mb-0">Misi Pelaksanaan</h2>
                        </div>
                        <div class="content-body">
                            <?= get_setting($conn, 'misi') ?>
                        </div>
                    </div>
                </div>

            </div>

            <div class="mt-5 text-center">
                <p class="text-muted mb-4">Kenali lebih dekat siapa di balik kemajuan layanan ini</p>
                <a href="<?= $domain ?>/aparatur" class="btn btn-dark btn-lg rounded-pill px-5 shadow-sm fw-medium">
                    <i class="fas fa-users me-2"></i> Lihat Jajaran Aparatur Desa
                </a>
            </div>

        </div>
    </div>
</div>

<?php require_once "footer.php"; ?>