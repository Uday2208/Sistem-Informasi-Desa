<?php
require_once "header.php";

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM banners WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$banner = $stmt->get_result()->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $link = $_POST['link'];
    $urutan = intval($_POST['urutan']);

    $image = $banner['image'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = time() . "_" . $_FILES['image']['name'];
        handle_upload($_FILES['image']['tmp_name'], $image);
    }

    $stmt2 = $conn->prepare("UPDATE banners SET title=?, subtitle=?, image=?, link=?, urutan=? WHERE id=?");
    $stmt2->bind_param("ssssii", $title, $subtitle, $image, $link, $urutan, $id);
    if ($stmt2->execute()) {
        header("Location: banner.php");
        exit;
    } else {
        $error = "Telah terjadi kesalahan saat update.";
    }
}
?>
<div class="d-flex justify-content-between mb-4">
    <h1 class="h3">Edit Banner Slider</h1>
    <a href="banner.php" class="btn btn-outline-secondary">Kembali</a>
</div>
<?php if (isset($error))
    echo "<div class='alert alert-danger'>$error</div>"; ?>
<div class="card shadow-sm border-0">
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Headline (Judul Utama)</label>
                <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($banner['title']) ?>"
                    required>
            </div>
            <div class="mb-3">
                <label>Subheadline (Deskripsi)</label>
                <textarea name="subtitle" class="form-control"
                    rows="3"><?= htmlspecialchars($banner['subtitle']) ?></textarea>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label>Timpa Gambar Baru (Format Landscape)</label>
                    <input type="file" name="image" accept="image/*" class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                    <label>URL / Link Tombol</label>
                    <input type="text" name="link" class="form-control"
                        value="<?= htmlspecialchars($banner['link']) ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label>Urutan Ditampilkan</label>
                    <input type="number" name="urutan" class="form-control"
                        value="<?= htmlspecialchars($banner['urutan']) ?>">
                </div>
            </div>
            <button type="submit" class="btn btn-primary d-block w-100">Update Banner</button>
        </form>
    </div>
</div>
<?php require_once "footer.php"; ?>