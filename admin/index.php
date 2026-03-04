<?php require_once "header.php"; ?>
<h1 class="mb-4">Dashboard Administrator</h1>
<div class="row">
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-header">Total Berita</div>
            <div class="card-body">
                <h5 class="card-title">
                    <?php
                    $res = $conn->query("SELECT COUNT(*) as total FROM berita");
                    echo $res->fetch_assoc()['total'];
                    ?>
                </h5>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success mb-3">
            <div class="card-header">Sitemap Generation</div>
            <div class="card-body">
                <p class="card-text">Sitemap otomatis tergenerate via sitemap.xml.</p>
                <a href="<?= $domain ?>/sitemap.xml" target="_blank" class="btn btn-light btn-sm">Lihat Sitemap</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-info mb-3">
            <div class="card-header">Page Speed</div>
            <div class="card-body">
                <p class="card-text">Website sudah dioptimasi dengan meta tags dan lazy loading image.</p>
            </div>
        </div>
    </div>
</div>
<?php require_once "footer.php"; ?>