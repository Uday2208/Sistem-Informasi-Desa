<?php require_once "header.php";

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM pengumuman WHERE id = $id");
    echo "<div class='alert alert-success'>Pengumuman dihapus.</div>";
}
if (isset($_GET['toggle'])) {
    $id = intval($_GET['toggle']);
    $conn->query("UPDATE pengumuman SET is_active = NOT is_active WHERE id = $id");
    header("Location: pengumuman.php");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $teks = $_POST['teks'];
    $stmt = $conn->prepare("INSERT INTO pengumuman (teks, is_active) VALUES (?, 1)");
    $stmt->bind_param("s", $teks);
    $stmt->execute();
}
?>
<div class="d-flex justify-content-between mb-4">
    <h1 class="h2">Running Text / Pengumuman</h1>
</div>

<div class="card shadow-sm border-0 mb-4 bg-light">
    <div class="card-body">
        <form method="POST" class="d-flex">
            <input type="text" name="teks" class="form-control me-2"
                placeholder="Masukkan teks pengumuman penting baru..." required>
            <button type="submit" class="btn btn-primary text-nowrap">Tambah Teks</button>
        </form>
    </div>
</div>

<div class="card shadow-sm border-0">
    <table class="table table-hover mb-0">
        <thead class="bg-white">
            <tr>
                <th>Isi Teks Pengumuman Berjalan</th>
                <th width="15%" class="text-center">Status Tampil</th>
                <th width="15%" class="text-center">Hapus</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $conn->query("SELECT * FROM pengumuman ORDER BY id DESC");
            while ($row = $stmt->fetch_assoc()):
                ?>
                <tr>
                    <td>
                        <?= htmlspecialchars($row['teks']) ?>
                    </td>
                    <td class="text-center">
                        <a href="?toggle=<?= $row['id'] ?>"
                            class="badge rounded-pill text-decoration-none <?= $row['is_active'] ? 'bg-success' : 'bg-secondary' ?>">
                            <?= $row['is_active'] ? 'Aktif' : 'Non-Aktif' ?>
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger px-3 rounded-pill"
                            onclick="return confirm('Hapus teks ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<?php require_once "footer.php"; ?>