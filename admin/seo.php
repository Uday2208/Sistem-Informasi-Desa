<?php
require_once "header.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process settings update
    $fields = ['site_title', 'meta_description', 'meta_keywords', 'meta_author', 'domain'];
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            $val = $_POST[$field];
            $stmt = $conn->prepare("UPDATE settings SET value = ? WHERE key_name = ?");
            $stmt->bind_param("ss", $val, $field);
            $stmt->execute();
        }
    }

    // Process file uploads for favicon and logo
    if (isset($_FILES['favicon']) && $_FILES['favicon']['error'] == 0) {
        $filename = "favicon_" . time() . ".png";
        move_uploaded_file($_FILES['favicon']['tmp_name'], "../uploads/" . $filename);
        $conn->query("UPDATE settings SET value = '$filename' WHERE key_name = 'favicon'");
    }

    if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
        $filename = "logo_" . time() . ".png";
        move_uploaded_file($_FILES['logo']['tmp_name'], "../uploads/" . $filename);
        $conn->query("UPDATE settings SET value = '$filename' WHERE key_name = 'logo'");
    }

    // Process robots.txt update
    if (isset($_POST['robots_txt'])) {
        file_put_contents("../robots.txt", trim($_POST['robots_txt']));
    }

    $msg = "Pengaturan SEO berhasil disimpan.";
}

// Fetch current robots.txt
$robots_content = file_exists("../robots.txt") ? file_get_contents("../robots.txt") : "";
?>
<h1 class="mb-4">Manajemen SEO Global</h1>
<?php if (isset($msg))
    echo "<div class='alert alert-success'>$msg</div>"; ?>

<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <h5 class="mb-3">General Meta Default</h5>
                    <div class="mb-3">
                        <label>Site Title</label>
                        <input type="text" name="site_title" class="form-control"
                            value="<?= htmlspecialchars(get_setting($conn, 'site_title')) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Meta Description Global</label>
                        <textarea name="meta_description" class="form-control" rows="3"
                            required><?= htmlspecialchars(get_setting($conn, 'meta_description')) ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Meta Keywords</label>
                        <input type="text" name="meta_keywords" class="form-control"
                            value="<?= htmlspecialchars(get_setting($conn, 'meta_keywords')) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Meta Author</label>
                        <input type="text" name="meta_author" class="form-control"
                            value="<?= htmlspecialchars(get_setting($conn, 'meta_author')) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Domain Server <small class="text-danger">(Wajib HTTPS untuk Sitemap & URL
                                Canonical)</small></label>
                        <input type="url" name="domain" class="form-control"
                            value="<?= htmlspecialchars(get_setting($conn, 'domain')) ?>" required>
                    </div>

                    <hr class="my-4">
                    <h5 class="mb-3">Images (Upload)</h5>
                    <div class="mb-3">
                        <label>Favicon</label>
                        <input type="file" name="favicon" class="form-control" accept="image/*">
                        <?php if (get_setting($conn, 'favicon')): ?>
                            <small class="text-muted d-block mt-1">Current: <img
                                    src="<?= $domain ?>/uploads/<?= htmlspecialchars(get_setting($conn, 'favicon')) ?>"
                                    style="max-height:30px;"></small>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label>Logo Website</label>
                        <input type="file" name="logo" class="form-control" accept="image/*">
                        <?php if (get_setting($conn, 'logo')): ?>
                            <small class="text-muted d-block mt-1">Current: <img
                                    src="<?= $domain ?>/uploads/<?= htmlspecialchars(get_setting($conn, 'logo')) ?>"
                                    style="max-height:30px;"></small>
                        <?php endif; ?>
                    </div>

                    <hr class="my-4">
                    <h5 class="mb-3">Robots.txt Configuration</h5>
                    <div class="mb-3">
                        <label>Isi File robots.txt</label>
                        <textarea name="robots_txt" class="form-control" rows="5"
                            style="font-family: monospace;"><?= htmlspecialchars($robots_content) ?></textarea>
                        <small class="text-muted">Untuk custom crawl rule Googlebot.</small>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Simpan Pengaturan SEO</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0 sticky-top" style="top: 20px;">
            <div class="card-header bg-primary text-white">Preview Snippet Google Beranda</div>
            <div class="card-body">
                <div class="google-snippet bg-light p-3 border rounded" style="font-family: 'Arial', sans-serif;">
                    <cite
                        style="color: #202124; font-size: 14px; font-style: normal; display: block; margin-bottom: 2px;">
                        <?= htmlspecialchars(get_setting($conn, 'domain')) ?>
                    </cite>
                    <h3
                        style="color: #1a0dab; font-size: 20px; font-weight: 400; margin: 0 0 3px 0; padding: 0; line-height:1.2;">
                        Beranda -
                        <?= htmlspecialchars(get_setting($conn, 'site_title')) ?>
                    </h3>
                    <p style="color: #4d5156; font-size: 14px; line-height: 1.58; margin: 0;">
                        <?= htmlspecialchars(get_setting($conn, 'meta_description')) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once "footer.php"; ?>