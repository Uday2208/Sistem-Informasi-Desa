<?php
$conn = new mysqli("localhost", "root", "", "sid_premium");

$conn->query("CREATE TABLE IF NOT EXISTS `pegawai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `urutan` int(11) DEFAULT 0,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)");

// Cek apakah tabel kosong
$res = $conn->query("SELECT COUNT(*) AS total FROM pegawai");
$row = $res->fetch_assoc();
if ($row['total'] == 0) {
    $conn->query("INSERT INTO pegawai (nama, jabatan, foto, urutan) VALUES 
    ('Budi Santoso, S.E.', 'Kepala Desa', 'https://randomuser.me/api/portraits/men/1.jpg', 1),
    ('Siti Aminah, S.Pd.', 'Sekretaris Desa', 'https://randomuser.me/api/portraits/women/2.jpg', 2),
    ('Agus Riyanto', 'Kaur Keuangan', 'https://randomuser.me/api/portraits/men/3.jpg', 3),
    ('Rini Marlina', 'Kaur Perencanaan', 'https://randomuser.me/api/portraits/women/4.jpg', 4),
    ('Hartono, S.H.', 'Kasi Pemerintahan', 'https://randomuser.me/api/portraits/men/5.jpg', 5),
    ('Dewi Kusumawati', 'Kasi Kesejahteraan', 'https://randomuser.me/api/portraits/women/6.jpg', 6)
    ");
    echo "Tabel pegawai berhasil dibuat dan diisi data dummy.\n";
} else {
    echo "Tabel pegawai sudah ada dan berisi data.\n";
}
