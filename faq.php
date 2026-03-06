<?php
$page_title = "Frequently Asked Questions";
require_once "header.php";

$page_meta_desc = "Tanya Jawab Seputar Layanan Pemerintahan dan Administrasi Desa " . $site_title;
?>
<!-- Modern Hero Header -->
<div class="position-relative overflow-hidden mb-5"
    style="background: linear-gradient(135deg, var(--primary-dark), var(--primary-color)); padding: 120px 0 80px;">
    <div class="position-absolute top-0 start-0 w-100 h-100 bg-pattern opacity-10"></div>
    <div class="container position-relative z-1 text-center text-white mt-4">
        <span class="badge bg-white text-primary rounded-pill px-3 py-2 fw-medium mb-3 shadow-sm">
            <i class="fas fa-question-circle me-1"></i> Bantuan & Layanan
        </span>
        <h1 class="display-4 fw-bold brand-font mb-3 text-shadow">Tanya Jawab (FAQ)</h1>
        <p class="lead fw-light opacity-75 mx-auto" style="max-width: 600px;">
            Solusi mandiri yang cepat untuk panduan umum seputar pelayanan publik di
            <?= htmlspecialchars($site_title) ?>
        </p>
    </div>
</div>

<div class="container mb-5 pb-5">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="accordion shadow-sm" id="accordionFAQ">
                <?php
                $stmt = $conn->query("SELECT * FROM faq ORDER BY urutan ASC, id DESC");
                $i = 0;
                while ($row = $stmt->fetch_assoc()):
                    $collapseId = "collapse" . $row['id'];
                    $headingId = "heading" . $row['id'];
                    ?>
                    <div class="accordion-item border-0 border-bottom">
                        <h2 class="accordion-header" id="<?= $headingId ?>">
                            <button
                                class="accordion-button <?= $i == 0 ? '' : 'collapsed' ?> fw-bold fs-5 text-dark bg-white"
                                type="button" data-bs-toggle="collapse" data-bs-target="#<?= $collapseId ?>"
                                aria-expanded="<?= $i == 0 ? 'true' : 'false' ?>" aria-controls="<?= $collapseId ?>">
                                <?= htmlspecialchars($row['pertanyaan']) ?>
                            </button>
                        </h2>
                        <div id="<?= $collapseId ?>" class="accordion-collapse collapse <?= $i == 0 ? 'show' : '' ?>"
                            aria-labelledby="<?= $headingId ?>" data-bs-parent="#accordionFAQ">
                            <div class="accordion-body text-muted lh-lg fs-6 p-4 bg-light">
                                <?= nl2br(htmlspecialchars($row['jawaban'])) ?>
                            </div>
                        </div>
                    </div>
                    <?php $i++; endwhile; ?>
            </div>

            <div class="mt-5 p-4 bg-primary text-white rounded-4 text-center shadow">
                <h4 class="fw-bold mb-3">Punya Pertanyaan Lain?</h4>
                <p>Silakan hubungi admin kami melalui WhatsApp untuk mendapatkan prioritas dan respon lebih lanjut
                    mengenai kendala Anda di desa.</p>
                <a href="<?= $domain ?>/kontak" class="btn btn-light rounded-pill fw-bold px-4 mt-2">Hubungi Tim Layanan
                    Desa</a>
            </div>
        </div>
    </div>
</div>

<style>
    .accordion-button:not(.collapsed) {
        background-color: #f8f9fa;
        color: #0d6efd !important;
        box-shadow: none;
        border-bottom: 2px solid #0d6efd;
    }

    .accordion-button:focus {
        box-shadow: none;
        border-color: rgba(0, 0, 0, .125);
    }

    .accordion-item {
        overflow: hidden;
    }
</style>
<?php require_once "footer.php"; ?>