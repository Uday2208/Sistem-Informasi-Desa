<?php
require_once "header.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanya = $_POST['pertanyaan'];
    $jawab = $_POST['jawaban'];
    $urutan = intval($_POST['urutan']);

    $stmt = $conn->prepare("INSERT INTO faq (pertanyaan, jawaban, urutan) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $tanya, $jawab, $urutan);
    if ($stmt->execute()) {
        header("Location: faq.php");
        exit;
    } else {
        $error = "Telah terjadi kesalahan saat menyimpan FAQ.";
    }
}
?>
<div class="d-flex justify-content-between mb-4">
    <h1 class="h3">Tambah Kuesioner FAQ</h1>
    <a href="faq.php" class="btn btn-outline-secondary">Kembali</a>
</div>
<?php if (isset($error))
    echo "<div class='alert alert-danger'>$error</div>"; ?>
<div class="card shadow-sm border-0">
    <div class="card-body">
        <form method="POST">
            <div class="mb-3">
                <label class="fw-bold">Bentuk Pertanyaan Umum Warga (Masalah Utama)</label>
                <input type="text" name="pertanyaan" class="form-control" required
                    placeholder="Cth: Dokumen apa saja jika ingin membuat surat cerai?">
            </div>
            <div class="mb-3">
                <label class="fw-bold">Format Jawaban Sistem (Solusi Lengkapnya)</label>
                <textarea name="jawaban" class="form-control" rows="5" required></textarea>
            </div>
            <div class="mb-4">
                <label class="fw-bold">Posisi Urutan Muncul (Prioritas)</label>
                <input type="number" name="urutan" class="form-control" value="0">
            </div>
            <button type="submit" class="btn btn-primary d-block w-100 fw-bold">Simpan FAQ</button>
        </form>
    </div>
</div>
<?php require_once "footer.php"; ?>