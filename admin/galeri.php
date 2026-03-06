<?php require_once "header.php";

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM galeri WHERE id = $id");
    echo "<div class='alert alert-success'>Foto Galeri dihapus.</div>";
}
?>
<div class="d-flex justify-content-between mb-4">
    <h1 class="h2">Galeri Foto</h1>
    <a href="galeri_tambah.php" class="btn btn-primary">Upload Foto</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Judul / Caption</th>
                    <th>Tanggal Upload</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $conn->query("SELECT * FROM galeri ORDER BY id DESC");
                while ($row = $stmt->fetch_assoc()):
                    $img_src = filter_var($row['image'], FILTER_VALIDATE_URL) ? $row['image'] : '../uploads/' . $row['image'];
                    ?>
                    <tr>
                        <td><img src="<?= htmlspecialchars($img_src) ?>" style="height: 50px; border-radius: 4px;"></td>
                        <td><strong>
                                <?= htmlspecialchars($row['title']) ?>
                            </strong></td>
                        <td>
                            <?= date("d M Y", strtotime($row['created_at'])) ?>
                        </td>
                        <td>
                            <a href="?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Hapus Foto ini dari Galeri?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once "footer.php"; ?>