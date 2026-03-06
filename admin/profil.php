<?php require_once "header.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process text fields
    $fields = ['visi', 'misi', 'sejarah', 'site_title'];
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            $val = $_POST[$field];
            $stmt = $conn->prepare("UPDATE settings SET value = ? WHERE key_name = ?");
            $stmt->bind_param("ss", $val, $field);
            $stmt->execute();
        }
    }
    
    // Process Logo Upload
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $filename = $_FILES['logo']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if (in_array($ext, $allowed)) {
            $new_filename = 'logo_' . time() . '.' . $ext;
            $upload_path = '../uploads/' . $new_filename;
            
            if (move_uploaded_file($_FILES['logo']['tmp_name'], $upload_path)) {
                $stmt = $conn->prepare("UPDATE settings SET value = ? WHERE key_name = 'logo'");
                $stmt->bind_param("s", $new_filename);
                $stmt->execute();
            }
        }
    }

    $msg = "Profil identitas dan logo desa berhasil diperbarui!";
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0 text-dark">Identitas & Profil Desa</h2>
        <p class="text-muted mb-0">Atur Visi, Misi, Sejarah, dan Logo Kelurahan/Desa Anda</p>
    </div>
</div>

<?php if (isset($msg)): ?>
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3" role="alert">
        <i class="fas fa-check-circle me-2"></i><?= $msg ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-lg-3 mb-4">
        <!-- Sidebar Navigation for Tabs -->
        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
            <div class="card-body p-3">
                <div class="nav flex-column nav-pills custom-pills" id="v-pills-tab" role="tablist"
                    aria-orientation="vertical">
                    <button class="nav-link active mb-2 text-start px-4 py-3 fw-medium" id="v-pills-logo-tab"
                        data-bs-toggle="pill" data-bs-target="#v-pills-logo" type="button" role="tab"
                        aria-controls="v-pills-logo" aria-selected="true">
                        <i class="fas fa-id-card text-info me-2 icon-tab"></i> Identitas & Logo
                    </button>
                    <button class="nav-link mb-2 text-start px-4 py-3 fw-medium" id="v-pills-visi-tab"
                        data-bs-toggle="pill" data-bs-target="#v-pills-visi" type="button" role="tab"
                        aria-controls="v-pills-visi" aria-selected="false">
                        <i class="fas fa-eye text-primary me-2 icon-tab"></i> Visi
                    </button>
                    <button class="nav-link mb-2 text-start px-4 py-3 fw-medium" id="v-pills-misi-tab"
                        data-bs-toggle="pill" data-bs-target="#v-pills-misi" type="button" role="tab"
                        aria-controls="v-pills-misi" aria-selected="false">
                        <i class="fas fa-bullseye text-success me-2 icon-tab"></i> Misi Pelaksanaan
                    </button>
                    <button class="nav-link text-start px-4 py-3 fw-medium" id="v-pills-sejarah-tab"
                        data-bs-toggle="pill" data-bs-target="#v-pills-sejarah" type="button" role="tab"
                        aria-controls="v-pills-sejarah" aria-selected="false">
                        <i class="fas fa-history text-warning me-2 icon-tab"></i> Sejarah / Latar Belakang
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-9">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 16px;">
            <div class="card-header bg-white border-0 pt-4 pb-2 px-4">
                <h5 class="fw-bold mb-0 text-dark"><i class="far fa-edit text-primary me-2"></i> Editor Informasi</h5>
            </div>
            <div class="card-body px-4 pb-4">
                <form method="POST" enctype="multipart/form-data">
                    <div class="tab-content" id="v-pills-tabContent">
                        
                        <!-- Tab Logo -->
                        <div class="tab-pane fade show active" id="v-pills-logo" role="tabpanel" aria-labelledby="v-pills-logo-tab">
                            <div class="mb-4">
                                <label for="site_title" class="form-label fw-bold text-dark mb-3">Nama Kelurahan / Desa</label>
                                <input type="text" name="site_title" id="site_title" class="form-control mb-4 fw-bold text-primary" style="font-size: 1.1rem;" value="<?= htmlspecialchars(get_setting($conn, 'site_title')) ?>" placeholder="Contoh: Desa Suka Maju" required>

                                <label for="logo" class="form-label fw-bold text-dark mb-3">Upload Logo Kelurahan/Desa</label>
                                
                                <div class="card border border-light bg-light rounded-3 mb-3 p-4 text-center">
                                    <?php $currentLogo = get_setting($conn, 'logo'); ?>
                                    <?php if ($currentLogo && file_exists('../uploads/' . $currentLogo)): ?>
                                        <img src="../uploads/<?= htmlspecialchars($currentLogo) ?>" alt="Logo Desa Saat Ini" class="img-fluid" style="max-height: 180px; object-fit: contain;">
                                    <?php else: ?>
                                        <div class="text-muted"><i class="fas fa-image fa-3x mb-2 opacity-50"></i><br>Belum ada logo</div>
                                    <?php endif; ?>
                                </div>
                                
                                <input type="file" name="logo" id="logo" class="form-control" accept="image/*">
                                <small class="text-muted mt-2 d-block"><i class="fas fa-info-circle me-1"></i> Format direkomendasikan: JPG atau PNG transparan. Maks: 2MB.</small>
                            </div>
                        </div>

                        <!-- Tab Visi -->
                        <div class="tab-pane fade" id="v-pills-visi" role="tabpanel"
                            aria-labelledby="v-pills-visi-tab">
                            <div class="mb-4">
                                <label for="visi" class="form-label fw-bold text-dark mb-3">Tuliskan Visi Kelurahan /
                                    Desa</label>
                                <textarea name="visi" id="visi" class="form-control" rows="6"
                                    placeholder="Ketikkan rincian visi di sini..."><?= htmlspecialchars(get_setting($conn, 'visi')) ?></textarea>
                            </div>
                        </div>

                        <!-- Tab Misi -->
                        <div class="tab-pane fade" id="v-pills-misi" role="tabpanel" aria-labelledby="v-pills-misi-tab">
                            <div class="mb-4">
                                <label for="misi" class="form-label fw-bold text-dark mb-3">Uraikan Misi
                                    Pelaksanaan</label>
                                <textarea name="misi" id="misi" class="form-control" rows="10"
                                    placeholder="Ketikkan rincian misi di sini..."><?= htmlspecialchars(get_setting($conn, 'misi')) ?></textarea>
                            </div>
                        </div>

                        <!-- Tab Sejarah -->
                        <div class="tab-pane fade" id="v-pills-sejarah" role="tabpanel"
                            aria-labelledby="v-pills-sejarah-tab">
                            <div class="mb-4">
                                <label for="sejarah" class="form-label fw-bold text-dark mb-3">Ceritakan Sejarah dan
                                    Latar Belakang</label>
                                <textarea name="sejarah" id="sejarah" class="form-control" rows="15"
                                    placeholder="Mulai menulis sejarah..."><?= htmlspecialchars(get_setting($conn, 'sejarah')) ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end border-top pt-4 mt-2">
                        <button type="submit" class="btn btn-primary px-5 py-2 fw-medium rounded-pill shadow-sm">
                            <i class="fas fa-save me-2"></i> Simpan Pembaruan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styling Tabs Navigation */
    .custom-pills .nav-link {
        color: #4b5563;
        border-radius: 12px;
        transition: all 0.3s ease;
        background-color: transparent;
    }

    .custom-pills .nav-link:hover {
        background-color: #f3f4f6;
        color: #1f2937;
        transform: translateX(5px);
    }

    .custom-pills .nav-link.active {
        background-color: #ebf5ff;
        color: #1d4ed8;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .custom-pills .nav-link.active .icon-tab {
        color: #1d4ed8 !important;
    }

    /* Styling Textarea */
    .form-control {
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        padding: 1rem;
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
        background-color: #f9fafb;
        transition: all 0.2s ease;
        line-height: 1.6;
    }

    .form-control:focus {
        background-color: #ffffff;
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
    }

    .form-control::placeholder {
        color: #9ca3af;
    }
</style>

<?php require_once "footer.php"; ?>