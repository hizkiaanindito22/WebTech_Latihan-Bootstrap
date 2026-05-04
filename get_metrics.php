<?php
include 'koneksi.php';

// ==========================================
// 1. Ambil data dari tabel 'waktu_respon'
// ==========================================
$query_waktu = "SELECT AVG(skor_respon) as rata_waktu FROM waktu_respon";
$result_waktu = mysqli_query($koneksi, $query_waktu);

$waktu_amanin = 3.5; // Nilai default jika kosong
if ($result_waktu && mysqli_num_rows($result_waktu) > 0) {
    $row_waktu = mysqli_fetch_assoc($result_waktu);
    if ($row_waktu['rata_waktu'] !== null) {
        $waktu_amanin = round($row_waktu['rata_waktu'], 1);
    }
}

// ==========================================
// 2. Ambil data dari tabel 'kepuasan_client'
// ==========================================
$query_puas = "SELECT AVG(skor_kepuasan) as rata_puas FROM kepuasan_client";
$result_puas = mysqli_query($koneksi, $query_puas);

$puas = 98; // Nilai default jika kosong
if ($result_puas && mysqli_num_rows($result_puas) > 0) {
    $row_puas = mysqli_fetch_assoc($result_puas);
    if ($row_puas['rata_puas'] !== null) {
        $puas = round($row_puas['rata_puas']);
    }
}
$tidak_puas = 100 - $puas;

// ==========================================
// 3. Kirim data ke JavaScript dalam format JSON
// ==========================================
header('Content-Type: application/json');
echo json_encode([
    'waktu_amanin' => $waktu_amanin,
    'puas'         => $puas,
    'tidak_puas'   => $tidak_puas
]);
?>