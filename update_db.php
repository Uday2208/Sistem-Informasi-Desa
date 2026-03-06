<?php
$conn = new mysqli("localhost", "root", "", "sid_premium");

$conn->query("CREATE TABLE IF NOT EXISTS `galeri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)");

$conn->query("TRUNCATE TABLE berita");
$conn->query("INSERT INTO berita (title, slug, content, meta_title, meta_description, meta_image) VALUES 
('Pembangunan Sarana Olahraga Desa Selesai', 'pembangunan-sarana-olahraga', '<p>Pembangunan lapangan warga menggunakan dana desa tahun 2026 berjalan lancar. Peresmian akan dilakukan bulan depan.</p>', 'Pembangunan Sarana Olahraga', 'Pembangunan sarana olahraga menggunakan dana desa.', 'https://picsum.photos/seed/lapangan/800/600'),
('Pelatihan Pemasaran Digital Bagi UMKM Desa', 'pelatihan-pemasaran-digital', '<p>Desa Sukamaju telah sukses menyelenggarakan pelatihan pemasaran digital yang diikuti oleh puluhan pelaku UMKM.</p>', 'Pelatihan UMKM Desa', 'Pelatihan digital marketing untuk warga desa.', 'https://picsum.photos/seed/pelatihan/800/600'),
('Bantuan Sosial Tunai (BST) Cair', 'bantuan-sosial-tunai', '<p>Pemerintah Desa memfasilitasi pencairan bantuan sosial tunai (BST) tahap 1 bagi warga prasejahtera.</p>', 'BST Cair 2026', 'Pencairan BST tahap 1 di desa Sukamaju.', 'https://picsum.photos/seed/bansos/800/600')
");

$conn->query("TRUNCATE TABLE umkm");
$conn->query("INSERT INTO umkm (nama, slug, deskripsi) VALUES 
('Keripik Pisang Makmur Asri', 'keripik-pisang-makmur', 'Produk andalan desa! Keripik pisang aneka rasa khas diproduksi secara higienis dengan bahan baku pisang kepok lokal. Tersedia dalam berbagai ukuran kemasan.'),
('Kopi Robusta Seduh Desa', 'kopi-robusta-desa', 'Kopi robusta asli hasil kebun warga desa. Dipetik merah untuk menjaga cita rasa khas. Cocok untuk menemani pagi atau sore Anda.'),
('Kerajinan Anyaman Bambu Lestari', 'kerajinan-bambu-lestari', 'Berbagai hasil karya kerajinan tangan berbahan dasar bambu dari kelompok pengrajin desa. Membuat interior menjadi lebih klasik.')
");

$conn->query("TRUNCATE TABLE layanan");
$conn->query("INSERT INTO layanan (nama, slug, deskripsi) VALUES 
('Surat Keterangan Usaha (SKU)', 'pembuatan-sku', 'Fasilitas layanan untuk para pelaku UMKM yang ingin mendaftarkan usahanya dan membuat NIB. Persyaratan: KTP, KK, Pengantar RT.'),
('Pengantar Akta Kelahiran & Kematian', 'pengurusan-akta', 'Pelayanan cepat surat pengantar akta ke Disdukcapil. Bawa dokumen rumah sakit atau surat keterangan yang sesuai.'),
('Surat Keterangan Tidak Mampu (SKTM)', 'pembuatan-sktm', 'Layanan pembuatan SKTM untuk warga kurang mampu. Persyaratan: Fotocopy KTP, KK, Rekening Listrik, dsb.')
");

$conn->query("TRUNCATE TABLE galeri");
$conn->query("INSERT INTO galeri (title, image) VALUES 
('Kegiatan Gotong Royong Rutin', 'https://picsum.photos/seed/gotong/800/600'),
('Pembagian Bibit Gratis dari Provinsi', 'https://picsum.photos/seed/bibit/800/600'),
('Musrenbangdes Tahun 2026', 'https://picsum.photos/seed/rapat/800/600'),
('Festival Budaya dan Hasil Bumi', 'https://picsum.photos/seed/festival/800/600'),
('Kunjungan Bupati ke Desa', 'https://picsum.photos/seed/bupati/800/600'),
('Peningkatan Jalan Desa Dusun 2', 'https://picsum.photos/seed/jalan/800/600')
");

echo "Dummy data generated.";
