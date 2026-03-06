<?php
require_once "header.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $urutan = intval($_POST['urutan']);

    $foto = "";
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $foto = time() . "_" . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], "../uploads/" . $foto);
    }

    $stmt = $conn->prepare("INSERT INTO pegawai (nama, jabatan, foto, urutan) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $nama, $jabatan, $foto, $urutan);
    if ($stmt->execute()) {
        header("Location: pegawai.php");
        exit;
    } else {
        $error = "Gagal menyimpan: " . $conn->error;
    }
}
?>
<div class="d-flex justify-content-between mb-4">
    <h1 class="h3">Tambah Pegawai Desa</h1>
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
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Jabatan Kepala/Staf (Cth: Kepala Desa)</label>
                    <input type="text" name="jabatan" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Urutan Ditampilkan (1=Paling Atas)</label>
                    <input type="number" name="urutan" class="form-control" value="0">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Foto Profile Pas Foto (3x4)</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                </div>
            </div>
            <button type="submit" class="btn btn-primary px-5 mt-3">Simpan Aparatur</button>
        </form>
    </div>
</div>
<?php require_once "footer.php"; ?>