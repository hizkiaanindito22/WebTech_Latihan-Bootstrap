<?php 
include 'koneksi.php';

// Menambahkan header agar CSS SweetAlert terbaca jika file ini diakses langsung
echo '<!DOCTYPE html>
<html lang="id">
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
    <style>body { font-family: "Poppins", sans-serif; }</style>
</head>
<body>';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_kontak'])) {
    $nama  = mysqli_real_escape_string($koneksi, $_POST['namaLengkap']);
    $email = mysqli_real_escape_string($koneksi, $_POST['alamatEmail']);
    $pesan = mysqli_real_escape_string($koneksi, $_POST['detailPesan']);

    $query = "INSERT INTO kontak (nama, email_address, pesan) VALUES ('$nama', '$email', '$pesan')";

    if (mysqli_query($koneksi, $query)) {
        // Pesan Sukses Profesional
        echo "<script>
            Swal.fire({
                title: 'Pesan Terkirim!',
                text: 'Terima kasih, $nama. Kami akan segera menghubungi Anda.',
                icon: 'success',
                confirmButtonColor: '#4f77ff',
                confirmButtonText: 'Kembali ke Beranda'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'index.php';
                }
            });
        </script>";
    } else {
        // Pesan Error Profesional
        echo "<script>
            Swal.fire({
                title: 'Gagal Mengirim!',
                text: 'Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.',
                icon: 'error',
                confirmButtonColor: '#dc3545'
            }).then(() => {
                window.history.back();
            });
        </script>";
    }
}

echo '</body></html>';
?>