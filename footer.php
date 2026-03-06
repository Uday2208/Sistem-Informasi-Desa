<footer class="footer-modern mt-0 pb-3">
    <div class="container">
        <div class="row align-items-center mb-5 pb-3 border-bottom border-light border-opacity-10">
            <div class="col-md-7 mb-4 mb-md-0">
                <h3 class="fw-bold mb-3 brand-font text-white d-flex align-items-center gap-2">
                    <?php if (!empty($logo)): ?>
                        <img src="<?= $domain ?>/uploads/<?= htmlspecialchars($logo) ?>" alt="Logo" height="40"
                            class="rounded-circle shadow-sm" style="object-fit: cover;">
                    <?php else: ?>
                        <i class="fas fa-landmark text-primary"></i>
                    <?php endif; ?>
                    <?= htmlspecialchars($site_title) ?>
                </h3>
                <p class="text-white-50 lead fs-6 pe-md-5 mb-0" style="line-height: 1.8;">
                    <?= htmlspecialchars($global_meta_desc) ?></p>
            </div>
            <div class="col-md-5 text-md-end text-start">
                <h5 class="fw-bold text-white mb-3 brand-font">Hubungi Kami</h5>
                <div class="d-flex flex-column gap-2 text-white-50">
                    <div><i class="fas fa-map-marker-alt text-primary me-2"></i>
                        <?= htmlspecialchars(get_setting($conn, 'alamat')) ?></div>
                    <div><i class="far fa-clock text-primary me-2"></i>
                        <?= htmlspecialchars(get_setting($conn, 'jam_kerja')) ?></div>
                    <div>
                        <i class="fab fa-whatsapp text-primary me-2"></i>
                        <a href="https://wa.me/<?= htmlspecialchars(get_setting($conn, 'whatsapp')) ?>"
                            class="text-white-50 text-decoration-none hover-text-white"
                            target="_blank"><?= htmlspecialchars(get_setting($conn, 'whatsapp')) ?></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-md-6 mb-3 mb-md-0 text-center text-md-start">
                <p class="mb-0 text-white-50"><small>&copy; <?= date("Y") ?> <?= htmlspecialchars($site_title) ?>. Hak
                        Cipta Dilindungi Undang-undang.</small></p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item"><a href="<?= $domain ?>/profil"
                            class="text-white-50 text-decoration-none small">Profil</a></li>
                    <li class="list-inline-item px-2 text-white-50">·</li>
                    <li class="list-inline-item"><a href="<?= $domain ?>/layanan"
                            class="text-white-50 text-decoration-none small">Layanan</a></li>
                    <li class="list-inline-item px-2 text-white-50">·</li>
                    <li class="list-inline-item"><a href="<?= $domain ?>/berita"
                            class="text-white-50 text-decoration-none small">Berita</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
<script src="<?= $domain ?>/assets/js/main.js" defer></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        window.addEventListener("scroll", function() {
            var navbar = document.querySelector(".navbar-glass");
            if (navbar) {
                if (window.scrollY > 50) {
                    navbar.classList.add("scrolled");
                } else {
                    navbar.classList.remove("scrolled");
                }
            }
        });
    });
</script>
</body>

</html>