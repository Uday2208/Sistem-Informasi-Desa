<?php require_once "header.php";

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM faq WHERE id = $id");
    echo "<div class='alert alert-success'>Tanya Jawab (FAQ) dihapus.</div>";
}
?>
<div class="d-flex justify-content-between mb-4">
    <h1 class="h2">Manajemen FAQ (Tanya Jawab)</h1>
    <a href="faq_tambah.php" class="btn btn-primary">Tambah FAQ</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th width="5%">Urut</th>
                    <th width="35%">Pertanyaan / Kendala</th>
                    <th width="45%">Set Jawaban</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $conn->query("SELECT * FROM faq ORDER BY urutan ASC, id DESC");
                while ($row = $stmt->fetch_assoc()):
                    ?>
                    <tr>
                        <td class="text-center fw-bold text-muted">
                            <?= htmlspecialchars($row['urutan']) ?>
                        </td>
                        <td><strong>
                                <?= htmlspecialchars($row['pertanyaan']) ?>
                            </strong></td>
                        <td><small class="text-muted">
                                <?= htmlspecialchars(substr($row['jawaban'], 0, 80)) ?>...
                            </small></td>
                        <td>
                            <a href="faq_edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Hapus pertanyaan relevan ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once "footer.php"; ?>