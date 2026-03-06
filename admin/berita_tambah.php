<?php
require_once "header.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $slug = create_slug($_POST['slug']);
    if (empty($slug))
        $slug = create_slug($title);
    $content = $_POST['content'];
    $meta_title = "";
    $meta_description = "";

    $meta_image = "";
    if (isset($_FILES['meta_image']) && $_FILES['meta_image']['error'] == 0) {
        $meta_image = time() . "_" . $_FILES['meta_image']['name'];
        move_uploaded_file($_FILES['meta_image']['tmp_name'], "../uploads/" . $meta_image);
    }

    $is_running_text = isset($_POST['is_running_text']) ? 1 : 0;

    $stmt = $conn->prepare("INSERT INTO berita (title, slug, content, meta_title, meta_description, meta_image, is_running_text) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssi", $title, $slug, $content, $meta_title, $meta_description, $meta_image, $is_running_text);

    if ($stmt->execute()) {
        header("Location: berita.php");
        exit;
    } else {
        $error = "Terjadi kesalahan: " . $conn->error;
    }
}
?>
<div class="d-flex justify-content-between mb-4">
    <h1 class="h3 mb-0">Tambah Berita Baru</h1>
    <a href="berita.php" class="btn btn-outline-secondary">Kembali</a>
</div>

<?php if (isset($error))
    echo "<div class='alert alert-danger'>$error</div>"; ?>

<form method="POST" enctype="multipart/form-data" id="form-berita">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4 border-0">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="fw-bold">Judul Berita</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Slug URL</label>
                        <input type="text" name="slug" id="slug" class="form-control"
                            placeholder="Biarkan kosong untuk generate otomatis dari judul">
                        <small class="text-muted">Gunakan huruf kecil dan strip (contoh: berita-desa-terbaru)</small>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Konten Artikel</label>
                        <div id="editor" style="height: 400px; background:#fff;"></div>
                        <input type="hidden" name="content" id="content">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm mb-4 border-0">
                <div class="card-body bg-light rounded">
                    <div class="mb-3">
                        <label class="fw-bold">Thumbnail Berita</label>
                        <input type="file" name="meta_image" class="form-control" accept="image/*">
                        <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">Rekomendasi ukuran <
                                300KB.</small>
                    </div>
                    <div class="mb-3 form-check form-switch mt-3 pt-2 border-top">
                        <input class="form-check-input" type="checkbox" role="switch" id="isRunningText"
                            name="is_running_text" value="1">
                        <label class="form-check-label fw-bold fw-bold" for="isRunningText"><small>Jadikan Running Text
                                (Pengumuman)</small></label>
                        <small class="text-muted d-block" style="font-size: 0.75rem;">Judul postingan ini akan tampil
                            bergulir di bagian atas Beranda publik situs Anda.</small>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary w-100 fw-bold py-2 shadow-sm">Simpan &
                        Publikasikan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    var quill = new Quill('#editor', {
        theme: 'snow',
        placeholder: 'Tulis isi konten yang informatif...',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{ 'header': 1 }, { 'header': 2 }],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                [{ 'indent': '-1' }, { 'indent': '+1' }],
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'align': [] }],
                ['link', 'image'],
                ['clean']
            ]
        }
    });

    var form = document.getElementById('form-berita');
    form.addEventListener('submit', function () {
        var content = document.getElementById('content');
        content.value = quill.root.innerHTML;
    });
</script>

<?php require_once "footer.php"; ?>