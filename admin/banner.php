<?php require_once "header.php";

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM banners WHERE id = $id");
    echo "<div class='alert alert-success'>Banner Slider dihapus.</div>";
}
?>
<div class="d-flex justify-content-between mb-4">
    <h1 class="h2">Manajemen Banner / Slider</h1>
    <a href="banner_tambah.php" class="btn btn-primary">Tambah Banner</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Judul Utama</th>
                    <th>Subjudul</th>
                    <th>Urutan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $conn->query("SELECT * FROM banners ORDER BY urutan ASC, id DESC");
                while ($row = $stmt->fetch_assoc()):
                    $img_src = filter_var($row['image'], FILTER_VALIDATE_URL) ? $row['image'] : '../uploads/' . $row['image'];
                    ?>
                    <tr>
                        <td><img src="<?= htmlspecialchars($img_src) ?>"
                                style="height: 60px; width:120px; object-fit: cover; border-radius: 4px;"></td>
                        <td><strong>
                                <?= htmlspecialchars($row['title']) ?>
                            </strong></td>
                        <td>
                            <?= htmlspecialchars(substr($row['subtitle'], 0, 50)) ?>...
                        </td>
                        <td>
                            <?= $row['urutan'] ?>
                        </td>
                        <td>
                            <a href="banner_edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Hapus banner ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once "footer.php"; ?>