<?php
require_once "header.php";
$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM berita WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$berita = $stmt->get_result()->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $slug = create_slug($_POST['slug']);
    if (empty($slug))
        $slug = create_slug($title);
    $content = $_POST['content'];
    $meta_title = !empty($_POST['meta_title']) ? $_POST['meta_title'] : $title;
    $meta_description = $_POST['meta_description'];

    $meta_image = $berita['meta_image'];
    if (isset($_FILES['meta_image']) && $_FILES['meta_image']['error'] == 0) {
        $meta_image = time() . "_" . $_FILES['meta_image']['name'];
        move_uploaded_file($_FILES['meta_image']['tmp_name'], "../uploads/" . $meta_image);
    }

    $stmt2 = $conn->prepare("UPDATE berita SET title=?, slug=?, content=?, meta_title=?, meta_description=?, meta_image=? WHERE id=?");
    $stmt2->bind_param("ssssssi", $title, $slug, $content, $meta_title, $meta_description, $meta_image, $id);

    if ($stmt2->execute()) {
        header("Location: berita.php");
        exit;
    } else {
        $error = "Terjadi kesalahan: " . $conn->error;
    }
}
?>
<div class="d-flex justify-content-between mb-4">
    <h1 class="h3 mb-0">Edit Berita:
        <?= htmlspecialchars($berita['title']) ?>
    </h1>
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
                        <input type="text" name="title" id="title" class="form-control"
                            value="<?= htmlspecialchars($berita['title']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Slug URL (SEO Friendly)</label>
                        <input type="text" name="slug" id="slug" class="form-control"
                            value="<?= htmlspecialchars($berita['slug']) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Konten Artikel</label>
                        <div id="editor" style="height: 400px; background:#fff;">
                            <?= $berita['content'] ?>
                        </div>
                        <input type="hidden" name="content" id="content">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm mb-4 border-primary">
                <div class="card-header bg-primary text-white fw-bold">SEO & Metadata</div>
                <div class="card-body bg-light">
                    <div class="mb-3">
                        <label class="fw-bold"><small>Meta Title</small></label>
                        <input type="text" name="meta_title" class="form-control form-control-sm"
                            value="<?= htmlspecialchars($berita['meta_title']) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold"><small>Meta Description</small></label>
                        <textarea name="meta_description" class="form-control form-control-sm" rows="4"
                            required><?= htmlspecialchars($berita['meta_description']) ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold"><small>Open Graph Image</small></label>
                        <?php if ($berita['meta_image']): ?>
                            <div class="mb-2 text-center bg-white p-2 border rounded">
                                <img src="<?= $domain ?>/uploads/<?= htmlspecialchars($berita['meta_image']) ?>"
                                    class="img-fluid rounded" style="max-height: 120px;">
                            </div>
                        <?php endif; ?>
                        <input type="file" name="meta_image" class="form-control form-control-sm" accept="image/*">
                        <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">Timpa gambar dengan upload
                            file baru. Biarkan kosong jika tidak ingin mengubah.</small>
                    </div>

                    <hr>
                    <button type="submit" class="btn btn-primary w-100 fw-bold py-2 shadow-sm">Update Berita
                        SEO</button>
                </div>
            </div>

            <div class="card shadow-sm border-0 mt-3 sticky-top" style="top: 20px;">
                <div class="card-header bg-dark text-white fw-bold"><small>Preview Snippet Pencarian Google</small>
                </div>
                <div class="card-body">
                    <div class="google-snippet" style="font-family: Arial, sans-serif;">
                        <cite
                            style="color: #202124; font-size: 14px; font-style: normal; display: block; margin-bottom: 2px;">
                            <?= htmlspecialchars(get_setting($conn, 'domain')) ?> > berita >
                            <?= htmlspecialchars($berita['slug']) ?>
                        </cite>
                        <h3
                            style="color: #1a0dab; font-size: 20px; font-weight: 400; margin: 0 0 3px 0; padding: 0; line-height:1.2;">
                            <?= htmlspecialchars($berita['meta_title']) ?>
                        </h3>
                        <p style="color: #4d5156; font-size: 14px; line-height: 1.58; margin: 0;">
                            <?= htmlspecialchars($berita['meta_description']) ?>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>

<script>
    var quill = new Quill('#editor', {
        theme: 'snow',
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