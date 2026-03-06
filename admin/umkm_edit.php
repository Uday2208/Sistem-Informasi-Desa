<?php
require_once "header.php";

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM umkm WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$umkm = $stmt->get_result()->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $slug = create_slug($_POST['slug']);
    if (empty($slug))
        $slug = create_slug($nama);
    $deskripsi = $_POST['deskripsi'];

    $stmt2 = $conn->prepare("UPDATE umkm SET nama=?, slug=?, deskripsi=? WHERE id=?");
    $stmt2->bind_param("sssi", $nama, $slug, $deskripsi, $id);
    if ($stmt2->execute()) {
        header("Location: umkm.php");
        exit;
    } else {
        $error = "Telah terjadi kesalahan.";
    }
}
?>
<div class="d-flex justify-content-between mb-4">
    <h1 class="h3">Edit UMKM:
        <?= htmlspecialchars($umkm['nama']) ?>
    </h1>
    <a href="umkm.php" class="btn btn-outline-secondary">Kembali</a>
</div>
<?php if (isset($error))
    echo "<div class='alert alert-danger'>$error</div>"; ?>
<div class="card shadow-sm border-0">
    <div class="card-body">
        <form method="POST">
            <div class="mb-3">
                <label>Nama UMKM / Produk</label>
                <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($umkm['nama']) ?>"
                    required>
            </div>
            <div class="mb-3">
                <label>Slug</label>
                <input type="text" name="slug" class="form-control" value="<?= htmlspecialchars($umkm['slug']) ?>">
            </div>
            <div class="mb-3">
                <label>Deskripsi (Alamat, Harga, Kontak, dll)</label>
                <textarea name="deskripsi" class="form-control" rows="5"
                    required><?= htmlspecialchars($umkm['deskripsi']) ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update UMKM</button>
        </form>
    </div>
</div>
<?php require_once "footer.php"; ?>