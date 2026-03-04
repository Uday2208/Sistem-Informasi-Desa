<?php
require_once "header.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $slug = create_slug($_POST['slug']);
    if (empty($slug))
        $slug = create_slug($title);
    $content = $_POST['content'];
    $meta_title = !empty($_POST['meta_title']) ? $_POST['meta_title'] : $title;
    $meta_description = $_POST['meta_description'];

    $meta_image = "";
    if (isset($_FILES['meta_image']) && $_FILES['meta_image']['error'] == 0) {
        $meta_image = time() . "_" . $_FILES['meta_image']['name'];
        move_uploaded_file($_FILES['meta_image']['tmp_name'], "../uploads/" . $meta_image);
    }

    $stmt = $conn->prepare("INSERT INTO berita (title, slug, content, meta_title, meta_description, meta_image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $title, $slug, $content, $meta_title, $meta_description, $meta_image);

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
                        <label class="fw-bold">Slug URL (SEO Friendly)</label>
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
            <div class="card shadow-sm mb-4 border-primary">
                <div class="card-header bg-primary text-white fw-bold">Optimasi SEO Halaman</div>
                <div class="card-body bg-light">
                    <div class="mb-3">
                        <label class="fw-bold"><small>1. Meta Title (Max 60 Karakter)</small></label>
                        <input type="text" name="meta_title" class="form-control form-control-sm"
                            placeholder="Otomatis dari Judul Berita jika kosong">
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold"><small>2. Meta Description (Max 160 Karakter)</small></label>
                        <textarea name="meta_description" class="form-control form-control-sm" rows="4" required
                            placeholder="Deskripsi ringkas yang menarik klik di hasil pencarian Google"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold"><small>3. Open Graph Image (Thumbnail Web / WA)</small></label>
                        <input type="file" name="meta_image" class="form-control form-control-sm" accept="image/*">
                        <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">Rekomendasi rasio 16:9,
                            ukuran gambar sebaiknya < 300KB agar loading cepat.</small>
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
    form.onsubmit = function () {
        var content = document.querySelector('input[name=content]');
        content.value = quill.root.innerHTML;
    };
</script>

<?php require_once "footer.php"; ?>