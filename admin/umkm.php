<?php require_once "header.php";

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM umkm WHERE id = $id");
    echo "<div class='alert alert-success'>Data UMKM dihapus.</div>";
}
?>
<div class="d-flex justify-content-between mb-4">
    <h1 class="h2">Data UMKM</h1>
    <a href="umkm_tambah.php" class="btn btn-primary">Tambah UMKM</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama UMKM</th>
                    <th>Slug</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $conn->query("SELECT * FROM umkm ORDER BY id DESC");
                while ($row = $stmt->fetch_assoc()):
                    ?>
                    <tr>
                        <td>
                            <?= $row['id'] ?>
                        </td>
                        <td><strong>
                                <?= htmlspecialchars($row['nama']) ?>
                            </strong></td>
                        <td><span class="badge bg-secondary">
                                <?= htmlspecialchars($row['slug']) ?>
                            </span></td>
                        <td>
                            <a href="<?= $domain ?>/umkm/<?= $row['slug'] ?>" target="_blank"
                                class="btn btn-sm btn-info text-white">Lihat</a>
                            <a href="umkm_edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Hapus UMKM ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once "footer.php"; ?>