# Sistem Informasi Desa (SID) Premium - SEO Optimized

## Fitur Utama
1. **PHP Native & Bootstrap 5** (Koding rapi, modular, mudah di kembangkan).
2. **Quill JS** untuk Rich Text Editor di halaman admin.
3. **Optimasi Technical & On-Page SEO (100% SEO Friendly)**.
    - Meta Tag, Title, Desc & Image dinamis yang diatur dari backend admin.
    - SEO Friendly / Clean URL via `.htaccess`.
    - Auto generate XML Sitemap (`/sitemap.xml`).
    - Editable `robots.txt` via Admin Dashboard.
    - JSON-LD Structured data otomatis (LocalBusiness, Organization, Article, BreadcrumbList).
    - Image loading "lazy" untuk performa (Pagespeed ready).
    - Mobile UI optimized and ready (CSS modern Bootstrap 5).

---

## Panduan Instalasi di XAMPP / Localhost
1. Buka folder instalasi (biasanya `c:\xampp\htdocs\`) dan pastikan semua file sudah ada di direktori `sistem-informasi-desa`.
2. Buka PHPMyAdmin (via `http://localhost/phpmyadmin`) melalui XAMPP Control Panel.
3. Import file `sid_premium.sql` untuk membuat databasenya secara otomatis.
4. Buka URL Web: `http://localhost/sistem-informasi-desa/`
5. Buka URL Admin: `http://localhost/sistem-informasi-desa/admin/login.php`
    - Username default: `admin`
    - Password default: `admin123`

---

## Panduan Pindah Ke Shared Hosting (cPanel / DirectAdmin)
1. Export Database `sid_premium` di localhost Anda.
2. Masukkan (Zip / Compress) semua file yang ada di folder project ini.
3. Upload `.zip` ke `public_html/` di file manager cPanel, lalu Ekstrak.
4. Buat MySQL Database & User di menu "MySQL Databases" pada cPanel Anda.
5. Import file `.sql` ke database yang baru dibuat di cPanel menggunakan menu PHPMyAdmin.
6. Edit file `config/database.php`, sesuaikan konfigurasi host, user, pass, dan dbnya.
7. Login Ke Dashboard Administrator website yang baru `https://namadomain.com/admin/`.
8. Pergi ke **Manajemen SEO Global** dan ubah pengaturan **Domain Server** ke nama domain Website Anda (Misal: `https://www.desa-sukamaju.com`). 
    - *PENTING: Langkah ini memastikan sitemap, URL di meta tag, dan image preview web mengarah ke domain baru yang valid*.

---

## Panduan Mendaftarkan ke Google Search Console (GSC)

Agar website pemerintah desa Anda tampil profesional dan mudah ditemukan di pencarian Google, ikuti langkah berikut:

1. **Pastikan Website Terindeks Cepat**
   - Website ini sudah memiliki peta situs di `https://namadomain.com/sitemap.xml`. File ini otomatis di-update ketika data CMS bertambah.
   
2. **Daftarkan Properti di GSC**
   1. Kunjungi website Google Search Console.
   2. Login menggunakan akun Gmail pengelola web desa / admin pemerintah.
   3. Tambahkan properti dengan mengisi nama website Anda di kolom **URL Prefix** (Misal: `https://namadomain.com`) dan Klik "Continue".
   
3. **Verifikasi Kepemilikan (Pilih salah satu)**
   - **Metode Tag HTML**: Google akan memberikan sebaris script tag `<meta name="google-site-verification" content="...">`.
     - Buka editor code hosting Anda dan pastekan bari kode tersebut ke file `header.php` di dalam tag `<head>`.
   - **Metode Upload File HTML** (Paling mudah): Download file HTML verifikasi dari GSC, lalu upload ke folder `public_html` di cPanel.
   - Klik **Verify** di halaman Search Console Anda.

4. **Submit Peta Situs (Sitemaps)**
   - Jika sudah masuk ke dasbor Search Console, klik menu **"Sitemaps"** atau **"Peta Situs"** di Sidebar bagian kiri.
   - Ketikkan `sitemap.xml` di kolom "Add a new sitemap".
   - Klik **Submit** (Kirim).
   - Sitemap akan berstatus "Success", dan secara otomatis Googlebot akan membaca keseluruhan link berita / umkm di dalam website Anda.
