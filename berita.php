<?php 
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita - AMANIN</title>
    <link rel="icon" type="image/png" href="./img/processed_image2.png">
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/customstyle.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        .news-header {
            padding: 100px 0 50px 0;
            background: linear-gradient(to right, var(--primary), #2a4db3);
        }
    </style>
</head>

<body>
    
    <!-- Navbar (Link diarahkan kembali ke index.php) -->
    <header class="header shadow-sm sticky-top" style="background-color: var(--bg-card);">
        <nav class="navbar navbar-expand-lg navbar-light p-0" id="mainNav">
            <div class="container-md"> 
                <a class="navbar-brand d-flex align-items-center" href="index.php">
                    <div class="rounded-circle border border-secondary" style="width: 40px; height: 40px; overflow: hidden;">
                        <img src="img/Gemini_Generated_Image_6vpono6vpono6vpo.png" alt="Logo Perusahaan" class="w-100 h-100" style="object-fit: cover;">
                    </div>
                    <span class="ml-2 h5 font-weight-bold mb-0 text-primary">AMANIN</span>
                </a>
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav"> 
                    <ul class="navbar-nav text-base font-weight-medium align-items-lg-center">
                        <li class="nav-item"><a class="nav-link text-secondary px-3" href="index.php#home">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link text-secondary px-3" href="index.php#services">Layanan</a></li>
                        <li class="nav-item"><a class="nav-link text-secondary px-3" href="index.php#about">Tentang Kami</a></li>
                        <li class="nav-item"><a class="nav-link text-secondary px-3" href="index.php#contact">Kontak</a></li>
                        <!-- Menu Berita Aktif di halaman ini -->
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

    <!-- Header Berita -->
    <section class="news-header text-center">
        <div class="container-md">
            <h1 class="display-4 font-weight-bold text-white mb-3">Pusat Informasi AMANIN</h1>
            <p class="lead text-white opacity-75">Update terbaru, tips keamanan, dan kegiatan operasional kami di lapangan.</p>
        </div>
    </section>

    <!-- Grid Card Berita -->
    <section class="py-5 bg-light min-vh-100">
        <div class="container-md">
            <div class="row">
                
                <?php
                // Ambil data berita dari database urut dari yang terbaru
                $query_berita = "SELECT * FROM berita ORDER BY tanggal_publikasi DESC";
                $result_berita = mysqli_query($koneksi, $query_berita);

                if ($result_berita && mysqli_num_rows($result_berita) > 0) {
                    while($row = mysqli_fetch_assoc($result_berita)) {
                        
                        // Logika Cek Gambar (Jika kosong, pakai gambar placeholder)
                        $gambar_berita = !empty($row['gambar']) ? 'img/' . $row['gambar'] : 'https://placehold.co/600x400/e9ecef/4f77ff?text=Berita+Amanin';
                        
                        // Potong teks agar tidak terlalu panjang di card (maks 100 karakter)
                        $ringkasan = substr(strip_tags($row['konten']), 0, 100) . '...';
                        
                        // Format Tanggal
                        $tanggal = date('d M Y', strtotime($row['tanggal_publikasi']));
                        ?>
                        
                        <!-- Card Template -->
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 border-0 shadow-sm card-hover-shadow rounded-lg">
                                <img src="<?php echo $gambar_berita; ?>" class="card-img-top" alt="Berita Image" style="height: 200px; object-fit: cover; border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem;">
                                <div class="card-body">
                                    <p class="text-secondary small font-weight-bold mb-2"><i class="fas fa-calendar-alt mr-1"></i> <?php echo $tanggal; ?></p>
                                    <h5 class="card-title font-weight-bold text-dark"><?php echo htmlspecialchars($row['judul']); ?></h5>
                                    <p class="card-text text-secondary"><?php echo $ringkasan; ?></p>
                                </div>
                                <div class="card-footer bg-transparent border-0 pt-0 pb-4">
                                    <a href="#" class="btn btn-sm btn-outline-primary rounded-pill px-4">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                        
                        <?php
                    }
                } else {
                    echo "<div class='col-12 text-center my-5'>
                            <i class='fas fa-newspaper fa-4x text-secondary mb-3 opacity-50'></i>
                            <h4 class='text-dark'>Belum ada berita.</h4>
                            <p class='text-secondary'>Nantikan update terbaru dari kami segera!</p>
                          </div>";
                }
                ?>

            </div>
        </div>
    </section>

    <footer class="bg-light py-4 border-top mt-auto">
        <div class="container-md"> 
            <p class="text-muted small text-center mb-0">&copy; 2026 PT Selalu Dibuat Aman.</p>
        </div>
    </footer>

    <!-- Script Wajib -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        // Logika Dark Mode untuk Berita
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