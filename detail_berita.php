<?php 
include 'koneksi.php';

// Tangkap ID Berita dari URL
$id_berita = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data berita dari database
$query = "SELECT * FROM berita WHERE id = $id_berita";
$result = mysqli_query($koneksi, $query);

// Jika berita tidak ditemukan (misal user mengubah URL sembarangan)
if (!$result || mysqli_num_rows($result) == 0) {
    echo "<script>alert('Berita tidak ditemukan!'); window.location.href='berita.php';</script>";
    exit;
}

$row = mysqli_fetch_assoc($result);

// Setel Gambar
$gambar_berita = !empty($row['gambar']) ? 'img/' . $row['gambar'] : 'https://placehold.co/1200x600/e9ecef/4f77ff?text=Berita+Amanin';
$tanggal = date('d M Y', strtotime($row['tanggal_publikasi']));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($row['judul_berita']); ?> - AMANIN</title>
    <!-- Ikon sesuai permintaan Anda -->
    <link rel="icon" type="image/png" href="./img/processed_image2.png">
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/customstyle.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        /* =======================================
           ANIMASI SMOOTH PAGE OPEN
           ======================================= */
        .page-enter-animation {
            animation: smoothDetailOpen 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
            opacity: 0;
            transform: translateY(40px) scale(0.97);
        }
        
        @keyframes smoothDetailOpen {
            0% { opacity: 0; transform: translateY(40px) scale(0.97); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* Desain Khusus Halaman Detail */
        .article-cover {
            width: 100%;
            height: 450px;
            object-fit: cover;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }
        
        .article-body {
            font-size: 1.15rem;
            line-height: 1.8;
            color: var(--text-muted);
            margin-top: 30px;
        }

        .article-body p {
            margin-bottom: 1.5rem;
        }
    </style>
</head>

<body>
    
    <!-- Navbar -->
    <header class="header shadow-sm sticky-top" style="background-color: var(--bg-card);">
        <nav class="navbar navbar-expand-lg navbar-light p-0" id="mainNav">
            <div class="container-md"> 
                <a class="navbar-brand d-flex align-items-center" href="index.php">
                    <div class="rounded-circle border border-secondary" style="width: 40px; height: 40px; overflow: hidden;">
                        <img src="img/Gemini_Generated_Image_6vpono6vpono6vpo.png" alt="Logo Perusahaan" class="w-100 h-100" style="object-fit: cover;">
                    </div>
                    <span class="ml-2 h5 font-weight-bold mb-0 text-primary">AMANIN</span>
                </a>
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav"> 
                    <ul class="navbar-nav text-base font-weight-medium align-items-lg-center">
                        <li class="nav-item"><a class="nav-link text-secondary px-3" href="index.php#home">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link text-secondary px-3" href="index.php#services">Layanan</a></li>
                        <li class="nav-item"><a class="nav-link text-secondary px-3" href="index.php#about">Tentang Kami</a></li>
                        <li class="nav-item"><a class="nav-link text-secondary px-3" href="index.php#contact">Kontak</a></li>
                        <li class="nav-item"><a class="nav-link text-secondary active px-3" href="berita.php">Berita</a></li>
                        
                        <li class="nav-item ml-lg-3 mt-2 mt-lg-0 pb-2 pb-lg-0">
                            <button id="darkModeToggle" class="btn btn-sm btn-outline-primary rounded-circle d-flex justify-content-center align-items-center" title="Ganti Tema" style="width: 35px; height: 35px;">
                                <i class="fas fa-moon"></i>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- WRAPPER ANIMASI UNTUK KONTEN -->
    <div class="page-enter-animation">
        
        <section class="py-5 bg-light min-vh-100">
            <div class="container-md" style="max-width: 900px;">
                
                <!-- Tombol Kembali -->
                <a href="berita.php" class="btn btn-outline-secondary btn-sm rounded-pill mb-4 font-weight-bold">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar Berita
                </a>

                <!-- Judul Artikel -->
                <h1 class="display-5 font-weight-bold text-dark mb-3">
                    <?php echo htmlspecialchars($row['judul_berita']); ?>
                </h1>
                
                <!-- Tanggal -->
                <p class="text-primary font-weight-bold mb-4">
                    <i class="fas fa-calendar-alt mr-2"></i>Dipublikasikan pada: <?php echo $tanggal; ?>
                </p>

                <!-- Gambar Artikel -->
                <img src="<?php echo $gambar_berita; ?>" alt="Cover Berita" class="article-cover mb-5">

                <!-- Full Text Konten Artikel -->
                <div class="article-body bg-white p-4 p-md-5 rounded-lg shadow-sm border border-gray-100">
                    <?php 
                        // nl2br berguna jika teks di database menggunakan Enter/Baris Baru biasa
                        // Jika Anda menyimpan HTML dari Text Editor (seperti TinyMCE), hapus nl2br()
                        echo nl2br(htmlspecialchars($row['konten'])); 
                    ?>
                </div>

                <hr class="my-5">
                <div class="text-center">
                    <p class="text-secondary small font-weight-bold">Bagikan artikel ini:</p>
                    <button class="btn btn-primary btn-sm rounded-circle mx-1" style="width: 35px; height: 35px;"><i class="fab fa-whatsapp"></i></button>
                    <button class="btn btn-info btn-sm rounded-circle mx-1" style="width: 35px; height: 35px;"><i class="fab fa-twitter"></i></button>
                    <button class="btn btn-primary btn-sm rounded-circle mx-1" style="width: 35px; height: 35px;"><i class="fab fa-facebook-f"></i></button>
                </div>

            </div>
        </section>

        <footer class="bg-light py-4 border-top mt-auto">
            <div class="container-md"> 
                <p class="text-muted small text-center mb-0">&copy; 2026 PT Selalu Dibuat Aman.</p>
            </div>
        </footer>
        
    </div> <!-- END WRAPPER ANIMASI -->

    <!-- Script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        // Logika Dark Mode
        document.addEventListener('DOMContentLoaded', () => {
            const darkModeToggle = document.getElementById('darkModeToggle');
            const htmlElement = document.documentElement; 

            function toggleTheme() {
                const currentTheme = htmlElement.getAttribute('data-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                htmlElement.setAttribute('data-theme', newTheme);
                localStorage.setItem('amanin-theme', newTheme);
                updateToggleIcon(newTheme);
            }

            function updateToggleIcon(theme) {
                if (!darkModeToggle) return; 
                if (theme === 'dark') {
                    darkModeToggle.innerHTML = '<i class="fas fa-sun"></i>';
                    darkModeToggle.classList.replace('btn-outline-primary', 'btn-outline-warning');
                } else {
                    darkModeToggle.innerHTML = '<i class="fas fa-moon"></i>';
                    if (darkModeToggle.classList.contains('btn-outline-warning')) {
                        darkModeToggle.classList.replace('btn-outline-warning', 'btn-outline-primary');
                    }
                }
            }

            if (darkModeToggle) darkModeToggle.addEventListener('click', toggleTheme);

            const savedTheme = localStorage.getItem('amanin-theme') || 'light';
            htmlElement.setAttribute('data-theme', savedTheme);
            updateToggleIcon(savedTheme);
        });
    </script>
</body>
</html>