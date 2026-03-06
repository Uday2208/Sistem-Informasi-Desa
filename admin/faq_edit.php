<?php
require_once "header.php";

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM faq WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$faq = $stmt->get_result()->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanya = $_POST['pertanyaan'];
    $jawab = $_POST['jawaban'];
    $urutan = intval($_POST['urutan']);

    $stmt2 = $conn->prepare("UPDATE faq SET pertanyaan=?, jawaban=?, urutan=? WHERE id=?");
    $stmt2->bind_param("ssii", $tanya, $jawab, $urutan, $id);
    if ($stmt2->execute()) {
        header("Location: faq.php");
        exit;
    } else {
        $error = "Gagal memproses update FAQ.";
    }
}
?>
<div class="d-flex justify-content-between mb-4">
    <h1 class="h3">Edit FAQ Solusi</h1>
    <a href="faq.php" class="btn btn-outline-secondary">Kembali</a>
</div>
<?php if (isset($error))
    echo "<div class='alert alert-danger'>$error</div>"; ?>
<div class="card shadow-sm border-0">
    <div class="card-body">
        <form method="POST">
            <div class="mb-3">
                <label class="fw-bold">Bentuk Pertanyaan Umum Warga</label>
                <input type="text" name="pertanyaan" class="form-control"
                    value="<?= htmlspecialchars($faq['pertanyaan']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="fw-bold">Format Jawaban Sistem</label>
                <textarea name="jawaban" class="form-control" rows="5"
                    required><?= htmlspecialchars($faq['jawaban']) ?></textarea>
            </div>
            <div class="mb-4">
                <label class="fw-bold">Posisi Urutan Muncul</label>
                <input type="number" name="urutan" class="form-control" value="<?= htmlspecialchars($faq['urutan']) ?>">
            </div>
            <button type="submit" class="btn btn-primary d-block w-100">Simpan Perubahan</button>
        </form>
    </div>
</div>
<?php require_once "footer.php"; ?>