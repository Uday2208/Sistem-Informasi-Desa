<?php
require_once "header.php";

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM pegawai WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$pegawai = $stmt->get_result()->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $urutan = intval($_POST['urutan']);

    $foto = $pegawai['foto'];
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $foto = time() . "_" . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], "../uploads/" . $foto);
    }

    $stmt2 = $conn->prepare("UPDATE pegawai SET nama=?, jabatan=?, foto=?, urutan=? WHERE id=?");
    $stmt2->bind_param("ssssi", $nama, $jabatan, $foto, $urutan, $id);
    if ($stmt2->execute()) {
        header("Location: pegawai.php");
        exit;
    } else {
        $error = "Telah terjadi kesalahan.";
    }
}
?>
<div class="d-flex justify-content-between mb-4">
    <h1 class="h3">Edit Aparatur:
        <?= htmlspecialchars($pegawai['nama']) ?>
    </h1>
    <a href="pegawai.php" class="btn btn-outline-secondary">Kembali</a>
</div>
<?php if (isset($error))
    echo "<div class='alert alert-danger'>$error</div>"; ?>
<div class="card shadow-sm border-0">
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Nama Lengkap (Beserta Gelar)</label>
                    <input type="text" name="nama" class="form-control"
                        value="<?= htmlspecialchars($pegawai['nama']) ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Jabatan (Cth: Kepala Desa)</label>
                    <input type="text" name="jabatan" class="form-control"
                        value="<?= htmlspecialchars($pegawai['jabatan']) ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Urutan Ditampilkan (1=Paling Atas)</label>
                    <input type="number" name="urutan" class="form-control"
                        value="<?= htmlspecialchars($pegawai['urutan']) ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Timpah Foto Baru (Pas Foto)</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                    <small class="text-muted mt-1 d-block">Biarkan kosong jika tetap menggunakan gambar
                        sebelumnya</small>
                </div>
            </div>
            <button type="submit" class="btn btn-primary px-5 mt-3">Update Data</button>
        </form>
    </div>
</div>
<?php require_once "footer.php"; ?>