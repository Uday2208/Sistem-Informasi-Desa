<?php require_once "header.php";

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM pegawai WHERE id = $id");
    echo "<div class='alert alert-success'>Data Aparatur dihapus.</div>";
}
?>
<div class="d-flex justify-content-between mb-4">
    <h1 class="h2">Data Aparatur / Pegawai Desa</h1>
    <a href="pegawai_tambah.php" class="btn btn-primary">Tambah Pegawai</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Urutan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $conn->query("SELECT * FROM pegawai ORDER BY urutan ASC, id DESC");
                while ($row = $stmt->fetch_assoc()):
                    $img_src = filter_var($row['foto'], FILTER_VALIDATE_URL) ? $row['foto'] : '../uploads/' . $row['foto'];
                    ?>
                    <tr>
                        <td><img src="<?= htmlspecialchars($img_src) ?>"
                                style="height: 50px; width:50px; object-fit: cover; border-radius: 50%;"></td>
                        <td><strong>
                                <?= htmlspecialchars($row['nama']) ?>
                            </strong></td>
                        <td><span class="badge bg-primary text-white">
                                <?= htmlspecialchars($row['jabatan']) ?>
                            </span></td>
                        <td>
                            <?= $row['urutan'] ?>
                        </td>
                        <td>
                            <a href="pegawai_edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Hapus aparatur ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once "footer.php"; ?>