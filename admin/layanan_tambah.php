<?php
require_once "header.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $slug = create_slug($_POST['slug']);
    if (empty($slug))
        $slug = create_slug($nama);
    $deskripsi = $_POST['deskripsi'];

    $stmt = $conn->prepare("INSERT INTO layanan (nama, slug, deskripsi) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nama, $slug, $deskripsi);
    if ($stmt->execute()) {
        header("Location: layanan.php");
        exit;
    } else {
        $error = "Telah terjadi kesalahan / slug ganda.";
    }
}
?>
<div class="d-flex justify-content-between mb-4">
    <h1 class="h3">Tambah Layanan Publik</h1>
    <a href="layanan.php" class="btn btn-outline-secondary">Kembali</a>
</div>
<?php if (isset($error))
    echo "<div class='alert alert-danger'>$error</div>"; ?>
<div class="card shadow-sm border-0">
    <div class="card-body">
        <form method="POST">
            <div class="mb-3">
                <label>Nama Layanan (Berisi singkatan dan penamaan, Cth: SKCK, Surat Pindah)</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Slug</label>
                <input type="text" name="slug" class="form-control"
                    placeholder="Biarkan kosong untuk otomatis dari nama">
            </div>
            <div class="mb-3">
                <label>Persyaratan (Jabarkan secara rinci)</label>
                <textarea name="deskripsi" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Layanan</button>
        </form>
    </div>
</div>
<?php require_once "footer.php"; ?>