<?php
require_once "config/database.php";

$meta_title = isset($page_title) ? $page_title . " - " . $site_title : $site_title;
$meta_description = isset($page_meta_desc) && !empty($page_meta_desc) ? $page_meta_desc : $global_meta_desc;
$meta_keywords = isset($page_meta_keys) && !empty($page_meta_keys) ? $page_meta_keys : $global_meta_keys;
$meta_image = isset($page_meta_image) && !empty($page_meta_image) ? $domain . "/uploads/" . $page_meta_image : $domain . "/uploads/" . $logo;
$canonical_url = $domain . $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- SEO Meta Tags -->
    <title>
        <?= htmlspecialchars($meta_title) ?>
    </title>
    <meta name="description" content="<?= htmlspecialchars($meta_description) ?>">
    <meta name="keywords" content="<?= htmlspecialchars($meta_keywords) ?>">
    <meta name="author" content="<?= htmlspecialchars($global_meta_author) ?>">
    <link rel="canonical" href="<?= htmlspecialchars($canonical_url) ?>">
    <?php if (!empty($favicon)): ?>
        <link rel="icon" href="<?= $domain ?>/uploads/<?= htmlspecialchars($favicon) ?>">
    <?php endif; ?>

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="<?= isset($og_type) ? $og_type : 'website' ?>">
    <meta property="og:url" content="<?= htmlspecialchars($canonical_url) ?>">
    <meta property="og:title" content="<?= htmlspecialchars($meta_title) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($meta_description) ?>">
    <meta property="og:image" content="<?= htmlspecialchars($meta_image) ?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?= htmlspecialchars($canonical_url) ?>">
    <meta property="twitter:title" content="<?= htmlspecialchars($meta_title) ?>">
    <meta property="twitter:description" content="<?= htmlspecialchars($meta_description) ?>">
    <meta property="twitter:image" content="<?= htmlspecialchars($meta_image) ?>">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= $domain ?>/assets/css/style.css">

    <!-- JSON-LD Structured Data Organization -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "GovernmentOrganization",
      "name": "<?= htmlspecialchars($site_title) ?>",
      "url": "<?= htmlspecialchars($domain) ?>"<?php if (!empty($logo)): ?>,
          "logo": "<?= $domain ?>/uploads/<?= htmlspecialchars($logo) ?>"
      <?php endif; ?>
    }
    </script>
    <?php if (isset($extra_structured_data))
        echo $extra_structured_data; ?>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="<?= $domain ?>/">SID Premium</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= $domain ?>/">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $domain ?>/berita">Berita</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $domain ?>/admin">Admin</a></li>
                </ul>
            </div>
        </div>
    </nav>