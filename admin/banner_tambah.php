<?php
require_once "header.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $link = $_POST['link'];
    $urutan = intval($_POST['urutan']);

    $image = "";
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = time() . "_" . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/" . $image);

        $stmt = $conn->prepare("INSERT INTO banners (title, subtitle, image, link, urutan) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $title, $subtitle, $image, $link, $urutan);
        if ($stmt->execute()) {
            header("Location: banner.php");
            exit;
        } else {
            $error = "Telah terjadi kesalahan saat menyimpan.";
        }
    } else {
        $error = "Gambar Banner (Hero) wajib diupload!";
    }
}
?>
<div class="d-flex justify-content-between mb-4">
    <h1 class="h3">Tambah Banner</h1>
    <a href="banner.php" class="btn btn-outline-secondary">Kembali</a>
</div>
<?php if (isset($error))
    echo "<div class='alert alert-danger'>$error</div>"; ?>
<div class="card shadow-sm border-0">
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Headline (Judul Utama)</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Subheadline (Deskripsi)</label>
                <textarea name="subtitle" class="form-control" rows="3"></textarea>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label>Gambat (HD Landscape)</label>
                    <input type="file" name="image" accept="image/*" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label>URL / Link Tombol Cth: `/berita`</label>
                    <input type="text" name="link" class="form-control" placeholder="/layanan">
                </div>
                <div class="col-md-4 mb-3">
                    <label>Prioritas Urutan Kemunculan</label>
                    <input type="number" name="urutan" class="form-control" value="0">
                </div>
            </div>
            <button type="submit" class="btn btn-primary d-block w-100">Simpan Banner</button>
        </form>
    </div>
</div>
<?php require_once "footer.php"; ?>