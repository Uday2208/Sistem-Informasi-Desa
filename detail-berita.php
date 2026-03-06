<?php
require_once "config/database.php";

$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
$stmt = $conn->prepare("SELECT * FROM berita WHERE slug = ?");
$stmt->bind_param("s", $slug);
$stmt->execute();
$berita = $stmt->get_result()->fetch_assoc();

if (!$berita) {
    header("HTTP/1.0 404 Not Found");
    echo "<div style='text-align:center; padding: 50px;'><h1>404 Not Found</h1><a href='" . $domain . "'>Kembali ke beranda</a></div>";
    exit;
}

$page_title = $berita['meta_title'] ? $berita['meta_title'] : $berita['title'];
$page_meta_desc = $berita['meta_description'];
$page_meta_image = $berita['meta_image'];
$og_type = 'article';

$extra_structured_data = '
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "' . htmlspecialchars($berita['title']) . '",
  "image": [
    "' . $domain . '/uploads/' . htmlspecialchars($berita['meta_image']) . '"
   ],
  "datePublished": "' . date("c", strtotime($berita['created_at'])) . '",
  "author": [{
      "@type": "Person",
      "name": "' . htmlspecialchars($global_meta_author) . '",
      "url": "' . $domain . '"
    }]
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [{
    "@type": "ListItem",
    "position": 1,
    "name": "Beranda",
    "item": "' . $domain . '/"
  },{
    "@type": "ListItem",
    "position": 2,
    "name": "Berita",
    "item": "' . $domain . '/berita"
  },{
    "@type": "ListItem",
    "position": 3,
    "name": "' . htmlspecialchars($berita['title']) . '"
  }]
}
</script>
';

require_once "header.php";
?>
<div class="container mt-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $domain ?>/">Beranda</a></li>
            <li class="breadcrumb-item"><a href="<?= $domain ?>/berita">Berita</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                <?= htmlspecialchars($berita['title']) ?>
            </li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-8 offset-md-2 bg-white p-4 shadow-sm rounded">
            <h1 class="fw-bold mb-3">
                <?= htmlspecialchars($berita['title']) ?>
            </h1>
            <p class="text-muted"><small>Diterbitkan pada:
                    <?= date("d M Y", strtotime($berita['created_at'])) ?>
                </small></p>
            <?php if ($berita['meta_image']):
                $img_src = filter_var($berita['meta_image'], FILTER_VALIDATE_URL) ? $berita['meta_image'] : $domain . '/uploads/' . $berita['meta_image'];
                ?>
                <img src="<?= htmlspecialchars($img_src) ?>" class="img-fluid mb-4 rounded w-100"
                    alt="<?= htmlspecialchars($berita['title']) ?>" loading="lazy">
            <?php endif; ?>
            <div class="content lh-lg">
                <?= $berita['content'] ?>
            </div>
        </div>
    </div>
</div>
<?php require_once "footer.php"; ?>