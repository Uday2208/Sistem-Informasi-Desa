<?php
require_once "header.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $image = "";

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = time() . "_" . $_FILES['image']['name'];
        handle_upload($_FILES['image']['tmp_name'], $image);

        $stmt = $conn->prepare("INSERT INTO galeri (title, image) VALUES (?, ?)");
        $stmt->bind_param("ss", $title, $image);
        if ($stmt->execute()) {
            header("Location: galeri.php");
            exit;
        } else {
            $error = "Telah terjadi kesalahan saat menyimpan ke database.";
        }
    } else {
        $error = "Gambar wajib diisi!";
    }
}
?>
<div class="d-flex justify-content-between mb-4">
    <h1 class="h3">Upload Foto ke Galeri</h1>
    <a href="galeri.php" class="btn btn-outline-secondary">Kembali</a>
</div>
<?php if (isset($error))
    echo "<div class='alert alert-danger'>$error</div>"; ?>
<div class="card shadow-sm border-0">
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Caption / Judul Kegiatan</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Pilih File Foto</label>
                <input type="file" name="image" accept="image/*" class="form-control" required>
                <small class="text-muted">Gunakan file JPG/PNG berukuran di bawah 1 MB.</small>
            </div>
            <button type="submit" class="btn btn-primary d-block w-100">Upload Data Galeri</button>
        </form>
    </div>
</div>
<?php require_once "footer.php"; ?>