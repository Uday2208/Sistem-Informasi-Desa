<?php require_once "header.php";

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM layanan WHERE id = $id");
    echo "<div class='alert alert-success'>Layanan dihapus.</div>";
}
?>
<div class="d-flex justify-content-between mb-4">
    <h1 class="h2">Data Layanan Publik</h1>
    <a href="layanan_tambah.php" class="btn btn-primary">Tambah Layanan</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Layanan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $conn->query("SELECT * FROM layanan ORDER BY id DESC");
                while ($row = $stmt->fetch_assoc()):
                    ?>
                    <tr>
                        <td>
                            <?= $row['id'] ?>
                        </td>
                        <td><strong>
                                <?= htmlspecialchars($row['nama']) ?>
                            </strong></td>
                        <td>
                            <a href="<?= $domain ?>/layanan/<?= $row['slug'] ?>" target="_blank"
                                class="btn btn-sm btn-info text-white">Lihat</a>
                            <a href="layanan_edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Hapus Layanan ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once "footer.php"; ?>