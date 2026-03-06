<?php require_once "header.php";

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM berita WHERE id = $id");
    echo "<div class='alert alert-success'>Berita berhasil dihapus.</div>";
}
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-4 border-bottom">
    <h1 class="h2">Manajemen Berita / Konten </h1>
    <a href="berita_tambah.php" class="btn btn-primary">Tambah Berita</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">ID</th>
                        <th width="40%">Judul Berita</th>
                        <th width="20%">Slug URL</th>
                        <th width="15%">Tgl Dibuat</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $conn->query("SELECT * FROM berita ORDER BY id DESC");
                    while ($row = $stmt->fetch_assoc()):
                        ?>
                        <tr>
                            <td>
                                <?= $row['id'] ?>
                            </td>
                            <td>
                                <strong>
                                    <?= htmlspecialchars($row['title']) ?>
                                </strong>
                                <?php if (isset($row['is_running_text']) && $row['is_running_text'] == 1): ?>
                                    <span class="badge bg-danger ms-1 mt-1"><i class="fas fa-bullhorn"></i> Running Text</span>
                                <?php endif; ?>
                            </td>
                            <td><span class="badge bg-secondary">
                                    <?= htmlspecialchars($row['slug']) ?>
                                </span></td>
                            <td>
                                <?= date("d M Y", strtotime($row['created_at'])) ?>
                            </td>
                            <td>
                                <a href="<?= $domain ?>/berita/<?= $row['slug'] ?>" target="_blank"
                                    class="btn btn-sm btn-info text-white">View</a>
                                <a href="berita_edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Hapus berita ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once "footer.php"; ?>