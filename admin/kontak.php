<?php require_once "header.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fields = ['alamat', 'email', 'whatsapp', 'jam_kerja', 'map_iframe'];
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            $val = $_POST[$field];
            $stmt = $conn->prepare("UPDATE settings SET value = ? WHERE key_name = ?");
            $stmt->bind_param("ss", $val, $field);
            $stmt->execute();
        }
    }
    $msg = "Kontak desa dan informasi operasional berhasil diperbarui!";
}
?>
<h1 class="mb-4">Kontak & Lokasi / Integrasi Google Maps</h1>
<?php if (isset($msg))
    echo "<div class='alert alert-success'>$msg</div>"; ?>
<form method="POST">
    <div class="row">
        <div class="col-md-5 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body bg-light">
                    <h5 class="mb-4 fw-bold">Kontak Informasi</h5>
                    <div class="mb-3">
                        <label class="fw-bold">Alamat Lengkap Kantor</label>
                        <textarea class="form-control" name="alamat" rows="3"
                            required><?= htmlspecialchars(get_setting($conn, 'alamat')) ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Alamat Email Resmi</label>
                        <input type="email" class="form-control" name="email"
                            value="<?= htmlspecialchars(get_setting($conn, 'email')) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Nomor WhatsApp Pelayanan</label>
                        <input type="text" class="form-control" name="whatsapp"
                            value="<?= htmlspecialchars(get_setting($conn, 'whatsapp')) ?>" required>
                        <small class="text-muted d-block mt-1">Diawali dengan 62 (contoh: 628123456789)</small>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Jadwal Jam Kerja / Pelayanan</label>
                        <input type="text" class="form-control" name="jam_kerja"
                            value="<?= htmlspecialchars(get_setting($conn, 'jam_kerja')) ?>" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="mb-4 fw-bold">Peta Google Maps (Iframe)</h5>
                    <div class="mb-3">
                        <label class="text-muted"><small>Buka lokasi wilayah kelurahan/desa Anda di Google Maps di
                                Browser -> Klik Share/Bagikan -> Pilih tab "Embed a Map" / Sematkan Peta -> Copy HTML
                                dan Paste di kolom ini.</small></label>
                        <textarea class="form-control" name="map_iframe" rows="5" required
                            style="font-family: monospace; font-size:12px;"><?= htmlspecialchars(get_setting($conn, 'map_iframe')) ?></textarea>
                    </div>

                    <div class="bg-light p-2 border rounded text-center">
                        <p class="mb-2 fw-bold"><small>Preview Map Saat Ini</small></p>
                        <div class="ratio ratio-21x9">
                            <?= get_setting($conn, 'map_iframe') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-5 text-end">
        <button type="submit" class="btn btn-primary btn-lg shadow px-5">Simpan Data Lokasi & Kontak</button>
    </div>
</form>
<?php require_once "footer.php"; ?>