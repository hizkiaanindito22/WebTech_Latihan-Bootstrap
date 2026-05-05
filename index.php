<?php 
include 'koneksi.php';

// Cek apakah ada data yang dikirim melalui POST (Dari Form Kontak)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_kontak'])) {
    $nama  = mysqli_real_escape_string($koneksi, $_POST['namaLengkap']);
    $email = mysqli_real_escape_string($koneksi, $_POST['alamatEmail']);
    $pesan = mysqli_real_escape_string($koneksi, $_POST['detailPesan']);

    $query = "INSERT INTO pesan_kontak (nama, email, pesan) VALUES ('$nama', '$email', '$pesan')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Pesan berhasil terkirim ke database AMANIN!');</script>";
    } else {
        echo "<script>alert('Gagal mengirim pesan: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>

<?php 
include 'sent_message.php'; // Atau gunakan require 'sent_message.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webnya-AMANIN</title>
    <!-- Perbaikan Jalur Favicon (Tetap Sesuai Permintaan Anda) -->
    <link rel="icon" type="image/png" href="./img/processed_image2.png">
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/customstyle.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Library SweetAlert2 (Jika dipanggil di halaman ini) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/chart.umd.min.js"></script>
    
    <style>
        section {
            scroll-margin-top: 50px; 
        }

        /* =======================================
           CSS ANIMASI POP-UP BERITA & TRIGGER
           ======================================= */
        .news-popup {
            position: fixed;
            bottom: 30px;
            right: -400px; /* Sembunyi di luar layar kanan */
            width: 320px;
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            z-index: 1050;
            transition: right 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .news-popup.show-popup {
            right: 20px; /* Meluncur masuk */
        }
        .news-popup .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(0,0,0,0.6);
            border: none;
            font-size: 1.2rem;
            color: #ffffff;
            cursor: pointer;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
            z-index: 2;
        }
        .news-popup .close-btn:hover {
            background: rgba(0,0,0,0.9);
        }

        /* Balon Bar Menempel di Kanan */
        .news-trigger {
            position: fixed;
            bottom: 40px;
            right: -150px; /* Tersembunyi default */
            background-color: var(--primary);
            border-radius: 20px 0 0 20px; /* Melengkung kiri, rata kanan */
            padding: 10px 15px 10px 20px;
            cursor: pointer;
            z-index: 1049;
            transition: right 0.4s ease, padding 0.2s;
            box-shadow: -2px 5px 15px rgba(0,0,0,0.2);
        }
        .news-trigger.show-trigger {
            right: 0; /* Menempel di kanan */
        }
        .news-trigger:hover {
            background-color: #3b5bdb;
            padding-right: 25px; /* Efek memanjang saat di-hover */
        }
    </style>
</head>

<body>
    
    <header class="header shadow-sm sticky-top" style="background-color: var(--bg-card);">
        <nav class="navbar navbar-expand-lg navbar-light p-0" id="mainNav">
            <div class="container-md"> 
                <a class="navbar-brand d-flex align-items-center" href="#home">
                    <div class="rounded-circle border border-secondary" style="width: 40px; height: 40px; overflow: hidden;">
                        <img src="img/Gemini_Generated_Image_6vpono6vpono6vpo.png" alt="Logo Perusahaan" class="w-100 h-100" style="object-fit: cover;">
                    </div>
                    <span class="ml-2 h5 font-weight-bold mb-0 text-primary">AMANIN</span>
                </a>
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav"> 
                    <!-- PERBAIKAN: Tombol Dark Mode dimasukkan KE DALAM ul -->
                    <ul class="navbar-nav text-base font-weight-medium align-items-lg-center">
                        <li class="nav-item">
                            <a class="nav-link text-secondary active smooth-scroll px-3" href="#home">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-secondary smooth-scroll px-3" href="#services">Layanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-secondary smooth-scroll px-3" href="#about">Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-secondary smooth-scroll px-3" href="#contact">Kontak</a>
                        </li>
                        
                        <!-- Menu Berita -->
                        <li class="nav-item">
                            <a class="nav-link text-secondary px-3" href="berita.php">Berita</a>
                        </li>

                        <!-- Tombol Dark Mode Pindah ke Sini -->
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

    <section id="home" class="hero">
        <div id="heroCarousel" class="carousel slide h-100" data-ride="carousel" data-interval="5000"> 
            <ol class="carousel-indicators">
                <li data-target="#heroCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#heroCarousel" data-slide-to="1"></li>
                <li data-target="#heroCarousel" data-slide-to="2"></li>
                <li data-target="#heroCarousel" data-slide-to="3"></li>
            </ol>

            <div class="carousel-inner h-100">
                <div class="carousel-item active h-100">
                    <img src="img/perumahan.png" class="d-block w-100 hero-image" alt="Petugas keamanan sedang berpatroli">
                    <div class="hero-overlay"></div> 
                    <div class="carousel-caption hero-caption-content"> 
                        <h1 class="display-4 font-weight-bold mb-3 text-white">MENCIPTAKAN LINGKUNGAN YANG AMAN.</h1>
                        <p class="lead text-white">Solusi Keamanan Terpadu untuk Ketenangan Pikiran Anda.</p>
                        <a href="#services" class="btn btn-primary mt-3 px-5 py-2 font-weight-bold shadow-lg smooth-scroll rounded">Jelajahi Solusi</a>
                    </div>
                </div>

                <div class="carousel-item h-100">
                    <img src="img/control room.png" class="d-block w-100 hero-image" alt="Sistem pengawasan digital">
                    <div class="hero-overlay"></div>
                    <div class="carousel-caption hero-caption-content">
                        <h1 class="display-4 font-weight-bold mb-3 text-white">PEMANTAUAN DENGAN AI.</h1>
                        <p class="lead text-white">Perlindungan Maksimal, Dibantu Kecerdasan Luar Biasa, Setiap Saat.</p>
                        <a href="#services" class="btn btn-primary mt-3 px-5 py-2 font-weight-bold shadow-lg smooth-scroll rounded">Lihat Detail</a>
                    </div>
                </div>

                <div class="carousel-item h-100">
                    <img src="img/mall2.png" class="d-block w-100 hero-image" alt="Tim pengawalan profesional">
                    <div class="hero-overlay"></div>
                    <div class="carousel-caption hero-caption-content">
                        <h1 class="display-4 font-weight-bold mb-3 text-white">PELAYANAN 24/7.</h1>
                        <p class="lead text-white">Bahkan saat anda Tertidur.</p>
                        <a href="#contact" class="btn btn-primary mt-3 px-5 py-2 font-weight-bold shadow-lg smooth-scroll rounded">Jadwalkan Konsultasi</a>
                    </div>
                </div>

                <div class="carousel-item h-100">
                    <img src="img/pengawalan.png" class="d-block w-100 hero-image" alt="Tim pengawalan profesional">
                    <div class="hero-overlay"></div>
                    <div class="carousel-caption hero-caption-content">
                        <h1 class="display-4 font-weight-bold mb-3 text-white">PENGAWALAN DI LAPANGAN.</h1>
                        <p class="lead text-white">Respon Cepat untuk menghargai Waktu.</p>
                        <a href="#about" class="btn btn-primary mt-3 px-5 py-2 font-weight-bold shadow-lg smooth-scroll rounded">Tentang Respons</a>
                    </div>
                </div>
            </div>

            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
    
    <section id="services" class="py-5 py-lg-5">
        <div class="services-overlay"></div>
        <div class="container-md text-center"> 
        <h2 class="h1 font-weight-bold mb-5 text-primary">Layanan Kami</h2>
        
        <div class="row text-left"> 
            <?php
            // Mengambil data dari tabel layanan
            $query_layanan = "SELECT * FROM layanan";
            $result_layanan = mysqli_query($koneksi, $query_layanan);

            if ($result_layanan && mysqli_num_rows($result_layanan) > 0) {
                while($row = mysqli_fetch_assoc($result_layanan)) {
                    
                    // Logika penentuan ikon
                    $icon_class = "fas fa-shield-alt";
                    if ($row['id'] == 1) { $icon_class = "fas fa-eye"; } 
                    elseif ($row['id'] == 2) { $icon_class = "fas fa-shield-alt"; } 
                    elseif ($row['id'] == 3) { $icon_class = "fas fa-satellite-dish"; }
                    ?>
                    
                    <div class="col-md-4 mb-4"> 
                        <div class="card h-100 border-0 shadow card-hover-shadow rounded-lg"> 
                            <div class="card-body text-center p-4 p-md-5">
                                <i class="<?php echo $icon_class; ?> fa-3x mb-3 text-primary"></i>
                                <h5 class="card-title font-weight-bold text-dark">
                                    <?php echo htmlspecialchars($row['nama_layanan']); ?>
                                </h5>
                                <p class="card-text text-secondary mt-3">
                                    <?php echo htmlspecialchars($row['keterangan']); ?>
                                </p>
                                <a href="#" class="btn btn-sm btn-outline-primary mt-3 rounded-pill">Pelajari Lebih Lanjut</a>
                            </div>
                        </div>
                    </div>
                    
                    <?php
                }
            } else {
                echo "<p class='text-center w-100'>Data layanan tidak ditemukan atau koneksi gagal.</p>";
            }
            ?>
            </div>
        </div>
    </section>

    <section id="about" class="py-4 py-lg-5 bg-light section-b">
        <div class="container-md text-center"> 
            <h2 class="h1 font-weight-bold mb-3 text-dark">Tentang AMANIN</h2>

            <p class="lead text-secondary mb-3">
                AMANIN adalah mitra terpercaya Anda dalam menjaga keamanan, didukung oleh integritas, teknologi, dan keandalan.
            </p>
            
            <div class="row mb-5 justify-content-center">
                <div class="col-lg-8">
                    <div class="embed-responsive embed-responsive-16by9 rounded-lg shadow-lg video-local-container" id="videoContainer">
                        <video id="mainVideo" preload="metadata" 
                                poster="https://placehold.co/1280x720/AAAAAA/FFFFFF?text=Placeholder+Video+Amanin+Studio" 
                                muted loop playsinline>
                            <source src="vid/ComPro.mp4" type="video/mp4">
                            Browser Anda tidak mendukung tag video.
                        </video>
                        <div class="video-overlay" id="videoOverlay">
                             <i class="far fa-play-circle play-button-local"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="story-scroll-container">
                <div class="story-wrapper" id="storyWrapper">

                    <div class="scroll-slide active animate-in-left" data-slide="1">
                        <div class="row pt-5 pb-3"> 
                            <div class="col-12">
                                <h3 class="h2 font-weight-bold mb-5 text-center text-dark">Perjalanan AMANIN</h3>
                                
                                <div class="timeline-navigation-wrapper">
                                    <!-- Area Sensor Hover -->
                                    <div class="scroll-sensor left-sensor" id="leftSensor"></div>
                                    <div class="scroll-sensor right-sensor" id="rightSensor"></div>

                                    <div class="timeline-container" id="timelineAmanin">
                                        
                                        <div class="timeline-item">
                                            <div class="mb-3"><i class="fas fa-calendar-alt fa-3x text-primary"></i></div>
                                            <h4 class="h5 font-weight-bold mb-1 text-dark">2010</h4>
                                            <p class="text-secondary small font-weight-bold mb-1">Pendirian Awal</p>
                                            <p class="text-secondary small">AMANIN didirikan dengan visi menciptakan lingkungan yang aman.</p>
                                            <span class="timeline-dot"></span>
                                        </div>

                                        <div class="timeline-item">
                                            <div class="mb-3"><i class="fas fa-users fa-3x text-primary"></i></div>
                                            <h4 class="h5 font-weight-bold mb-1 text-dark">2013</h4>
                                            <p class="text-secondary small font-weight-bold mb-1">Ekspansi Kapasitas</p>
                                            <p class="text-secondary small">Mendirikan kantor pusat pertama dan merekrut 1500 anggota pengamanan.</p>
                                            <span class="timeline-dot"></span>
                                        </div>

                                        <div class="timeline-item">
                                            <div class="mb-3"><i class="fas fa-medal fa-3x text-primary"></i></div>
                                            <h4 class="h5 font-weight-bold mb-1 text-dark">2014</h4>
                                            <p class="text-secondary small font-weight-bold mb-1">Pengakuan Nasional</p>
                                            <p class="text-secondary small">Diakui dan disertifikasi oleh Kementerian Keamanan Negara.</p>
                                            <span class="timeline-dot"></span>
                                        </div>
                                        
                                        <div class="timeline-item">
                                            <div class="mb-3"><i class="fas fa-chart-line fa-3x text-primary"></i></div>
                                            <h4 class="h5 font-weight-bold mb-1 text-dark">2016</h4>
                                            <p class="text-secondary small font-weight-bold mb-1">Pertumbuhan Anggota</p>
                                            <p class="text-secondary small">Total anggota pengamanan mencapai 5000 personil terlatih.</p>
                                            <span class="timeline-dot"></span>
                                        </div>

                                         <div class="timeline-item">
                                            <div class="mb-3"><i class="fas fa-building fa-3x text-primary"></i></div>
                                            <h4 class="h5 font-weight-bold mb-1 text-dark">2020</h4>
                                            <p class="text-secondary small font-weight-bold mb-1">Pembangunan Markas Baru</p>
                                            <p class="text-secondary small">Mendirikan Menara Keamanan Barat - Jl. Sakti, Indonesia.</p>
                                            <span class="timeline-dot"></span>
                                        </div>

                                        <div class="timeline-item">
                                            <div class="mb-3"><i class="fas fa-handshake fa-3x text-primary"></i></div>
                                            <h4 class="h5 font-weight-bold mb-1 text-dark">2024</h4>
                                            <p class="text-secondary small font-weight-bold mb-1">Jaringan Klien</p>
                                            <p class="text-secondary small">Dipercaya oleh total 250 klien nasional, termasuk 40 pusat perbelanjaan (mall).</p>
                                            <span class="timeline-dot"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 

                    <div class="scroll-slide animate-in-right" data-slide="2">
                        <div class="row text-left align-items-center h-100 py-5"> 
                            <div class="col-lg-12 d-flex flex-column justify-content-center align-items-center"> 
                                <h3 class="h3 font-weight-bold mb-3 text-dark text-center">Fokus pada Integritas dan Keandalan</h3>
                                <p class="lead text-secondary text-center mb-4" style="max-width: 700px;">
                                    Kami adalah tim keamanan profesional yang berdedikasi untuk memberikan solusi perlindungan terbaik. Kami mengintegrasikan teknologi modern, seperti AI-powered surveillance, dan personel terlatih untuk memastikan lingkungan yang aman bagi setiap klien, dari skala kecil hingga korporasi besar.
                                </p>
                                <a href="#contact" class="btn btn-outline-primary mt-3 px-4 rounded-pill smooth-scroll">Hubungi Kami</a>
                            </div>
                        </div>
                    </div>

                    <div class="scroll-slide animate-in-right" data-slide="3">
                        <div class="row text-left align-items-center h-100 py-5"> 
                            <div class="col-lg-12 pt-md-4 d-flex justify-content-center align-items-center"> 
                                <div class="metrics-chart-wrapper" style="width: 100%; max-width: 900px; margin: 0 auto;"> 
                                    <h3 class="h3 font-weight-bold mb-4 text-dark text-center">Metrik Kinerja Utama</h3>
                                    
                                    <div class="chart-container-group bg-white p-4 p-md-5 rounded-lg shadow-lg border border-gray-100">
                                        <div class="row align-items-center"> 
                                            
                                            <!-- Kolom Kiri: Waktu Respons -->
                                            <div class="col-md-6 mb-4 mb-md-0">
                                                <div class="chart-wrapper">
                                                    <h4 class="h5 font-weight-bold mb-3 text-dark text-center">Waktu Respons</h4>
                                                    <div style="height: 250px;"> 
                                                        <canvas id="responseChart"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            <!-- Kolom Kanan: Tingkat Kepuasan -->
                                            <div class="col-md-6 border-left-md">
                                                <div class="chart-wrapper">
                                                    <h4 class="h5 font-weight-bold mb-3 text-dark text-center">Tingkat Kepuasan Klien</h4>
                                                    <div style="height: 250px;"> 
                                                        <canvas id="satisfactionChart"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> 
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                <button class="btn btn-lg btn-outline-primary mx-3 slide-nav-btn" id="prevSlide" disabled>
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="btn btn-lg btn-primary mx-3 slide-nav-btn" id="nextSlide">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            <hr class="my-5">
            
        </div>
    </section>

    <section id="contact" class="py-5 py-lg-5"> 
        <div class="contact-overlay"></div>
        <div class="container-md text-center" style="max-width: 800px;"> 
            <h2 class="h1 font-weight-bold mb-3 text-white">Kontak Kami</h2>
            <p class="lead font-weight-bold mb-3 text-white">Dapatkan Perlindungan Terbaik!</p>

            <form action="sent_message.php" method="POST" class="bg-white p-4 p-md-5 rounded-lg shadow-lg border border-gray-100"> 
                <div class="form-row"> 
                    <div class="form-group col-md-6"> 
                        <input type="text" name="namaLengkap" class="form-control rounded" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="form-group col-md-6"> 
                        <input type="email" name="alamatEmail" class="form-control rounded" placeholder="Alamat Email" required>
                    </div>
                </div>
                
                <div class="form-group"> 
                    <textarea name="detailPesan" class="form-control rounded" placeholder="Detail Proyek atau Pertanyaan Anda" rows="4" required></textarea>
                </div>

                <div class="pt-2 text-left"> 
                    <button type="submit" name="submit_kontak" class="btn btn-primary font-weight-semibold px-4 py-2 shadow rounded">
                        Kirim Pesan
                    </button>
                </div>
            </form>
        </div>
    </section>

    <footer class="bg-light py-4 border-top">
        <div class="container-md"> 
            <p class="text-muted small text-center mb-0">&copy; 2026 PT Selalu Dibuat Aman.</p>
            <p class="text-muted small text-center mb-0">Menara Keamanan Barat - Jl. Sakti, Indonesia</p>
        </div>
    </footer>

    <!-- ===================================
         ELEMEN POP-UP BERITA (Dengan Gambar)
         =================================== -->
    <div id="newsPopup" class="news-popup shadow-lg rounded">
        <div class="position-relative">
            <!-- Gambar Pop-Up -->
            <img src="img/perumahan.png" alt="Berita AMANIN" class="w-100 rounded-top" style="height: 130px; object-fit: cover;">
            <!-- Tombol Silang (Close) -->
            <button id="closeNews" class="close-btn" title="Tutup">&times;</button>
        </div>
        <div class="p-3">
            <h5 class="font-weight-bold text-primary mb-2"><i class="fas fa-newspaper"></i> Berita Terbaru!</h5>
            <p class="text-secondary small mb-3">Cek update keamanan dan kegiatan operasional dari tim AMANIN di lapangan.</p>
            <a href="berita.php" class="btn btn-sm btn-primary btn-block rounded-pill font-weight-bold">Baca Selengkapnya</a>
        </div>
    </div>

    <!-- ===================================
         ELEMEN BALON/BAR KANAN (Saat Pop-up disembunyikan)
         =================================== -->
    <div id="newsTrigger" class="news-trigger d-flex align-items-center" title="Buka Berita">
        <i class="fas fa-bell text-white"></i>
        <span class="text-white small font-weight-bold ml-2">Berita</span>
    </div>

    <!-- PENTING: Urutan script Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // ===================================
        // 0. LOGIKA POP-UP BERITA & TRIGGER BAR
        // ===================================
        document.addEventListener('DOMContentLoaded', () => {
            const newsPopup = document.getElementById('newsPopup');
            const closeNews = document.getElementById('closeNews');
            const newsTrigger = document.getElementById('newsTrigger');
            
            // Cek di storage apakah user sebelumnya sudah menekan "Tutup"
            const isPopupHidden = localStorage.getItem('hideNewsPopup');

            if (isPopupHidden === 'true') {
                // Jika sudah ditutup sebelumnya, langsung munculkan balon kecil di kanan
                if (newsTrigger) {
                    newsTrigger.classList.add('show-trigger');
                }
            } else {
                // Jika belum, luncurkan Pop-up setelah 4 detik
                if (newsPopup) {
                    setTimeout(() => {
                        newsPopup.classList.add('show-popup');
                    }, 4000); 
                }
            }

            // Aksi saat tombol SILANG (Tutup) diklik
            if (closeNews) {
                closeNews.addEventListener('click', () => {
                    newsPopup.classList.remove('show-popup'); // Tarik pop-up keluar layar
                    localStorage.setItem('hideNewsPopup', 'true'); // Ingat pilihan user
                    
                    // Setelah pop-up hilang, munculkan balon/bar di kanan
                    setTimeout(() => {
                        if (newsTrigger) newsTrigger.classList.add('show-trigger');
                    }, 600); // Jeda waktu 0.6 detik
                });
            }

            // Aksi saat BALON KANAN diklik
            if (newsTrigger) {
                newsTrigger.addEventListener('click', () => {
                    newsTrigger.classList.remove('show-trigger'); // Tarik balon masuk
                    localStorage.setItem('hideNewsPopup', 'false'); // Reset memori
                    
                    // Setelah balon menghilang, luncurkan kembali pop-up gambar
                    setTimeout(() => {
                        if (newsPopup) newsPopup.classList.add('show-popup');
                    }, 400); 
                });
            }
        });

        // ===================================
        // 1. LOGIKA DARK MODE AMANIN
        // ===================================
        // Dijalankan saat DOM siap agar elemen ditemukan
        document.addEventListener('DOMContentLoaded', () => {
            const darkModeToggle = document.getElementById('darkModeToggle');
            const htmlElement = document.documentElement; // Target tag <html>

            // Fungsi Ganti Tema
            function toggleTheme() {
                const currentTheme = htmlElement.getAttribute('data-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                
                htmlElement.setAttribute('data-theme', newTheme);
                localStorage.setItem('amanin-theme', newTheme);
                updateToggleIcon(newTheme);
            }

            // Fungsi Update Ikon
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

            // Pasang Event Listener
            if (darkModeToggle) {
                darkModeToggle.addEventListener('click', toggleTheme);
            }

            // Cek preferensi awal saat web dimuat
            const savedTheme = localStorage.getItem('amanin-theme') || 'light';
            htmlElement.setAttribute('data-theme', savedTheme);
            updateToggleIcon(savedTheme);
        });

        // ===================================
        // 2. MENU NAVIGASI AKTIF & SMOOTH SCROLL
        // ===================================
        const sections = document.querySelectorAll("section");
        const navLinks = document.querySelectorAll(".navbar-nav .nav-link");

        document.querySelectorAll('.smooth-scroll').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({ behavior: 'smooth' });
            });
        });

        window.addEventListener("scroll", () => {
            let current = "";
            sections.forEach((section) => {
                const sectionTop = section.offsetTop;
                if (pageYOffset >= sectionTop - 100) {
                    current = section.getAttribute("id");
                }
            });

            if ((window.innerHeight + Math.round(window.scrollY)) >= document.body.offsetHeight - 10) {
                current = "contact";
            }

            navLinks.forEach((a) => {
                a.classList.remove("active");
                if (a.getAttribute("href") === "#" + current) {
                    a.classList.add("active");
                }
            });
        });
                
        // ===================================
        // 3. LOGIKA VIDEO PROFIL
        // ===================================
        const mainVideo = document.getElementById('mainVideo');
        const videoOverlay = document.getElementById('videoOverlay');
        const videoContainer = document.getElementById('videoContainer');
        let userInteracted = false; 

        function toggleVideo() {
            if (mainVideo.paused || mainVideo.ended) {
                mainVideo.play();
                mainVideo.muted = false; 
                mainVideo.controls = true; 
                videoOverlay.classList.add('hidden');
                userInteracted = true;
            } else {
                mainVideo.pause();
                mainVideo.muted = true; 
                mainVideo.controls = false; 
                videoOverlay.classList.remove('hidden');
                userInteracted = false;
            }
        }
        
        if (videoContainer) videoContainer.addEventListener('click', toggleVideo);

        const options = { root: null, rootMargin: '0px', threshold: 0.5 };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                const video = entry.target;
                if (entry.isIntersecting) {
                    if (!userInteracted) {
                        video.play().catch(error => {});
                        videoOverlay.classList.add('autoplay-active'); 
                        video.controls = false; 
                    }
                } else {
                    if (!video.paused) {
                        video.pause();
                        videoOverlay.classList.remove('autoplay-active');
                        video.controls = false;
                    }
                }
            });
        }, options);

        if (mainVideo) {
            observer.observe(mainVideo);
            mainVideo.addEventListener('ended', () => {
                videoOverlay.classList.remove('autoplay-active'); 
                videoOverlay.classList.remove('hidden'); 
                mainVideo.controls = false;
                userInteracted = false;
                mainVideo.muted = true; 
                mainVideo.currentTime = 0; 
            });
            mainVideo.controls = false; 
        }

        // ===================================
        // 4. LOGIKA SLIDESHOW & TRIGGER ANIMASI
        // ===================================
        const slides = document.querySelectorAll('.scroll-slide');
        const prevButton = document.getElementById('prevSlide');
        const nextButton = document.getElementById('nextSlide');
        
        let currentSlide = 1;
        const totalSlides = slides.length;
        let isTransitioning = false;

        function updateSlides(direction) {
            if (isTransitioning) return;
            isTransitioning = true;

            const activeSlide = document.querySelector('.scroll-slide.active');
            const nextSlide = document.querySelector(`[data-slide="${currentSlide}"]`);

            if (activeSlide) {
                activeSlide.classList.remove('active', 'animate-in-left', 'animate-in-right');
                activeSlide.classList.add('animate-out');
            }

            if (nextSlide) {
                const enterClass = direction === 'next' ? 'animate-in-right' : 'animate-in-left';
                setTimeout(() => {
                    nextSlide.classList.remove('animate-out');
                    nextSlide.classList.add('active', enterClass);
                    
                    if (currentSlide === 3) {
                        playChartAnimations();
                    }

                    setTimeout(() => {
                        isTransitioning = false;
                        updateButtons();
                    }, 800); 
                }, 50);
            }
        }

        function updateButtons() {
            if (prevButton) prevButton.disabled = currentSlide === 1;
            if (nextButton) nextButton.disabled = currentSlide === totalSlides;
        }

        if (prevButton) {
            prevButton.addEventListener('click', () => {
                if (currentSlide > 1) { currentSlide--; updateSlides('prev'); }
            });
        }
        if (nextButton) {
            nextButton.addEventListener('click', () => {
                if (currentSlide < totalSlides) { currentSlide++; updateSlides('next'); }
            });
        }

        // ===================================
        // 5. MENGEMBALIKAN WHEEL SCROLL CAROUSEL
        // ===================================
        const storyScrollContainer = document.querySelector('.story-scroll-container');
        let lastWheelTime = 0;
        
        if (storyScrollContainer) {
            storyScrollContainer.addEventListener('wheel', function(e) {
                if (Math.abs(e.deltaX) > Math.abs(e.deltaY)) return; 

                let direction = e.deltaY > 0 ? 'next' : 'prev';
                const now = Date.now();

                if ((direction === 'next' && currentSlide < totalSlides) || 
                    (direction === 'prev' && currentSlide > 1)) {
                    
                    e.preventDefault(); 
                    if (now - lastWheelTime >= 1000) { 
                        if (direction === 'next') { currentSlide++; updateSlides('next'); } 
                        else { currentSlide--; updateSlides('prev'); }
                        lastWheelTime = now;
                    }
                }
            }, { passive: false });
        }

        // ===================================
        // LOGIKA HOVER SCROLL TIMELINE AMANIN
        // ===================================
        document.addEventListener('DOMContentLoaded', () => {
            const timeline = document.getElementById('timelineAmanin');
            const leftSensor = document.getElementById('leftSensor');
            const rightSensor = document.getElementById('rightSensor');

            let isScrolling = false;
            let scrollDirection = '';
            const scrollSpeed = 6; // Semakin besar angka, semakin cepat scrollnya

            // Fungsi scroll animasi yang jauh lebih mulus (Smooth 60FPS)
            function performScroll() {
                if (!isScrolling || !timeline) return;
                
                if (scrollDirection === 'left') {
                    timeline.scrollLeft -= scrollSpeed;
                } else if (scrollDirection === 'right') {
                    timeline.scrollLeft += scrollSpeed;
                }
                
                // Panggil frame berikutnya secara terus menerus selama isScrolling = true
                requestAnimationFrame(performScroll);
            }

            if (leftSensor && rightSensor && timeline) {
                // Event untuk Sensor Kiri
                leftSensor.addEventListener('mouseenter', () => {
                    isScrolling = true;
                    scrollDirection = 'left';
                    requestAnimationFrame(performScroll);
                });
                leftSensor.addEventListener('mouseleave', () => {
                    isScrolling = false;
                });

                // Event untuk Sensor Kanan
                rightSensor.addEventListener('mouseenter', () => {
                    isScrolling = true;
                    scrollDirection = 'right';
                    requestAnimationFrame(performScroll);
                });
                rightSensor.addEventListener('mouseleave', () => {
                    isScrolling = false;
                });

                // (Opsional) Dukungan sentuhan jika dibuka di layar sentuh laptop/tablet
                leftSensor.addEventListener('touchstart', (e) => { 
                    e.preventDefault(); 
                    isScrolling = true; 
                    scrollDirection = 'left'; 
                    requestAnimationFrame(performScroll); 
                }, {passive: false});
                leftSensor.addEventListener('touchend', () => { isScrolling = false; });
                
                rightSensor.addEventListener('touchstart', (e) => { 
                    e.preventDefault(); 
                    isScrolling = true; 
                    scrollDirection = 'right'; 
                    requestAnimationFrame(performScroll); 
                }, {passive: false});
                rightSensor.addEventListener('touchend', () => { isScrolling = false; });
            }

            // Fungsi untuk memaksa scroll ke ujung kanan (tahun 2024) saat slide dibuka
            window.scrollToLatest = function() {
                if (timeline) {
                    setTimeout(() => { 
                        timeline.scrollLeft = timeline.scrollWidth; 
                    }, 100);
                }
            };
        });

        // ===================================
        // 7. INISIALISASI CHART JS & ANIMASI
        // ===================================
        let responseChart;
        let satisfactionChart;
        const primaryColor = '#4f77ff'; 
        const secondaryColor = '#6c757d'; 

        function playChartAnimations() {
            if (responseChart && satisfactionChart) {
                const targetWaktu = responseChart.data.datasets[1].data[0] || 0;
                const targetPuas = satisfactionChart.data.datasets[0].data[0] || 0;
                const targetTidakPuas = satisfactionChart.data.datasets[0].data[1] || 100;

                responseChart.data.datasets[1].data = [0];
                satisfactionChart.data.datasets[0].data = [0, 100];
                responseChart.update('none');
                satisfactionChart.update('none');

                setTimeout(() => {
                    responseChart.data.datasets[1].data = [targetWaktu];
                    satisfactionChart.data.datasets[0].data = [targetPuas, targetTidakPuas];
                    responseChart.update(); 
                    satisfactionChart.update();
                }, 100);
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            
            updateSlides('next'); 
            scrollToLatest();
            
            const responseCtx = document.getElementById('responseChart');
            if (responseCtx) {
                responseChart = new Chart(responseCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Waktu Respons'],
                        datasets: [
                            {
                                label: 'Respon Petugas Umum (5 Menit)',
                                data: [5], 
                                backgroundColor: 'rgba(93, 111, 128, 0.2)', 
                                barPercentage: 0.5, 
                                categoryPercentage: 1.0
                            },
                            {
                                label: 'Respon AMANIN (Loading...)',
                                data: [0],
                                backgroundColor: primaryColor, 
                                barPercentage: 0.5, 
                                categoryPercentage: 1.0
                            }
                        ]
                    },
                    options: {
                        animation: { duration: 1500, easing: 'easeOutQuart' },
                        indexAxis: 'y', 
                        grouped: false, 
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        if (context.datasetIndex === 1) return ' Waktu: ' + context.raw + ' Menit';
                                        else return ' Target: ' + context.raw + ' Menit';
                                    }
                                }
                            }
                        },
                        scales: {
                            x: { max: 6, beginAtZero: true, title: { display: true, text: 'Waktu (Menit)', color: secondaryColor }, ticks: { color: secondaryColor }, grid: { display: false } },
                            y: { ticks: { display: false }, grid: { display: false } }
                        }
                    }
                });
            }

            const satisfactionCtx = document.getElementById('satisfactionChart');
            if (satisfactionCtx) {
                satisfactionChart = new Chart(satisfactionCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Puas (Loading...)', 'Tidak Puas'],
                        datasets: [{
                            data: [0, 100], 
                            backgroundColor: [ primaryColor, '#dc3545' ],
                            hoverOffset: 10
                        }]
                    },
                    options: {
                        animation: { duration: 1500, easing: 'easeOutQuart' },
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '75%', 
                        layout: { padding: 20 },
                        plugins: {
                            legend: { position: 'bottom', labels: { color: secondaryColor } },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        let label = context.label || '';
                                        if (label) label += ': ';
                                        label += context.raw + '%';
                                        return label;
                                    }
                                }
                            }
                        }
                    },
                    plugins: [{
                        id: 'textCenter',
                        beforeDraw: function(chart) {
                            const width = chart.width, height = chart.height, ctx = chart.ctx;
                            ctx.restore();
                            const fontSize = (height / 150).toFixed(2);
                            ctx.font = '700 ' + fontSize + 'em sans-serif'; 
                            ctx.textBaseline = 'middle';
                            
                            const val = chart.data.datasets[0].data[0];
                            const text = val + '%', 
                                  textX = Math.round((width - ctx.measureText(text).width) / 2), 
                                  textY = height / 2;
                            
                            ctx.fillStyle = primaryColor; 
                            ctx.fillText(text, textX, textY);
                            ctx.save();
                        }
                    }]
                });
            }

            function updateMetricsRealtime() {
                fetch('get_metrics.php?t=' + new Date().getTime())
                    .then(response => {
                        if(!response.ok) throw new Error('Jaringan Error');
                        return response.json();
                    })
                    .then(data => {
                        if (responseChart) {
                            let currentWaktu = responseChart.data.datasets[1].data[0];
                            if (currentWaktu !== data.waktu_amanin) {
                                responseChart.data.datasets[1].data = [data.waktu_amanin];
                                responseChart.data.datasets[1].label = `Respon AMANIN (${data.waktu_amanin} Menit)`;
                                responseChart.update(); 
                            }
                        }

                        if (satisfactionChart) {
                            let currentPuas = satisfactionChart.data.datasets[0].data[0];
                            if (currentPuas !== data.puas) {
                                satisfactionChart.data.datasets[0].data = [data.puas, data.tidak_puas];
                                satisfactionChart.data.labels = [`Puas (${data.puas}%)`, `Tidak Puas (${data.tidak_puas}%)`];
                                satisfactionChart.update(); 
                            }
                        }
                    })
                    .catch(error => console.error('Gagal memuat data metrik:', error));
            }

            updateMetricsRealtime(); 
            setInterval(updateMetricsRealtime, 3000); 
        });
    </script>
</body>
</html>