<?php
require_once "config/database.php";
header("Content-Type: text/xml;charset=iso-8859-1");
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>
            <?= $domain ?>/
        </loc>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>
            <?= $domain ?>/berita
        </loc>
        <priority>0.8</priority>
    </url>
    <?php
    $news = $conn->query("SELECT slug, created_at FROM berita ORDER BY id DESC");
    while ($row = $news->fetch_assoc()):
        ?>
        <url>
            <loc>
                <?= $domain ?>/berita/
                <?= $row['slug'] ?>
            </loc>
            <lastmod>
                <?= date("Y-m-d", strtotime($row['created_at'])) ?>
            </lastmod>
            <priority>0.8</priority>
        </url>
    <?php endwhile; ?>

    <?php
    $umkm = $conn->query("SELECT slug, created_at FROM umkm ORDER BY id DESC");
    while ($row = $umkm->fetch_assoc()):
        ?>
        <url>
            <loc>
                <?= $domain ?>/umkm/
                <?= $row['slug'] ?>
            </loc>
            <lastmod>
                <?= date("Y-m-d", strtotime($row['created_at'])) ?>
            </lastmod>
            <priority>0.7</priority>
        </url>
    <?php endwhile; ?>

    <?php
    $layanan = $conn->query("SELECT slug, created_at FROM layanan ORDER BY id DESC");
    while ($row = $layanan->fetch_assoc()):
        ?>
        <url>
            <loc>
                <?= $domain ?>/layanan/
                <?= $row['slug'] ?>
            </loc>
            <lastmod>
                <?= date("Y-m-d", strtotime($row['created_at'])) ?>
            </lastmod>
            <priority>0.7</priority>
        </url>
    <?php endwhile; ?>
</urlset>