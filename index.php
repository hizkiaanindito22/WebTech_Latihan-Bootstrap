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

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webnya-AMANIN</title>
    <link rel="icon" type="image/png" href="img/processed_image2.png">
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/customstyle.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <script src="js/chart.umd.min.js"></script>
    
    <style>
        section {
            scroll-margin-top: 50px; 
        }
        
        /* =======================================
           FIX TINGGI HALAMAN TENTANG KAMI
           ======================================= */
        .story-wrapper {
            position: relative;
            min-height: 550px; 
            width: 100%;
        }

        .scroll-slide {
            width: 100%;
            position: absolute; 
            top: 0;
            left: 0;
            opacity: 0;
            visibility: hidden;
            transition: all 0.6s ease;
        }

        .scroll-slide.active {
            position: relative; 
            opacity: 1;
            visibility: visible;
            z-index: 2;
        }

        /* =======================================
           CSS TIMELINE AMANIN (4/5 ITEM & HOVER)
           ======================================= */
        .timeline-navigation-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
            overflow: hidden;
        }

        .timeline-container {
            display: flex;
            align-items: flex-start;
            overflow-x: auto;
            padding: 20px 0;
            width: 100%;
            scroll-behavior: auto !important; 
            scrollbar-width: none; 
        }

        .timeline-container::-webkit-scrollbar {
            display: none; 
        }

        .timeline-item {
            flex: 0 0 22%; 
            min-width: 220px; 
            text-align: center;
            padding: 0 10px;
            position: relative;
        }

        .scroll-sensor {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 10%; 
            z-index: 10;
            cursor: pointer;
        }

        .left-sensor { 
            left: 0; 
            background: linear-gradient(to right, rgba(248,249,250, 0.9) 0%, transparent 100%);
        }
        .right-sensor { 
            right: 0; 
            background: linear-gradient(to left, rgba(248,249,250, 0.9) 0%, transparent 100%);
        }

        /* Garis dan Titik Timeline */
        .timeline-spacer {
            position: relative;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .timeline-spacer hr {
            border-top: 2px solid #dee2e6;
            margin: 0;
        }
        .timeline-dot {
            height: 12px;
            width: 12px;
            background-color: #4f77ff;
            border-radius: 50%;
            display: inline-block;
            position: absolute;
            bottom: -5px; /* Menyesuaikan posisi titik di bawah teks */
            left: 50%;
            transform: translateX(-50%);
        }

        /* Chart Styles */
        .chart-wrapper {
            position: relative;
            padding: 10px;
        }
    </style>
</head>

<body>
    
    <header class="header bg-white shadow-sm sticky-top">
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
                    <ul class="navbar-nav text-base font-weight-medium">
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

            <form action="" method="POST" class="bg-white p-4 p-md-5 rounded-lg shadow-lg border border-gray-100"> 
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

    <script src="js/jquery.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script>
        // ===================================
        // 1. MENU NAVIGASI AKTIF & SMOOTH SCROLL
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
        // 2. LOGIKA VIDEO PROFIL
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
        // 3. LOGIKA SLIDESHOW & TRIGGER ANIMASI
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
                    
                    // --- TRIGGER ANIMASI KETIKA SLIDE 3 (METRIK) TERBUKA ---
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
        // 4. MENGEMBALIKAN WHEEL SCROLL CAROUSEL
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
        // 5. LOGIKA HOVER SCROLL TIMELINE & DEFAULT 2024
        // ===================================
        const timeline = document.getElementById('timelineAmanin');
        const leftSensor = document.getElementById('leftSensor');
        const rightSensor = document.getElementById('rightSensor');

        let scrollInterval;
        const scrollSpeed = 6; 

        function startScrolling(direction) {
            stopScrolling();
            if (!timeline) return;
            scrollInterval = setInterval(() => {
                if (direction === 'left') timeline.scrollLeft -= scrollSpeed;
                else timeline.scrollLeft += scrollSpeed;
            }, 15);
        }

        function stopScrolling() { clearInterval(scrollInterval); }

        if(leftSensor && rightSensor) {
            leftSensor.addEventListener('mouseenter', () => startScrolling('left'));
            leftSensor.addEventListener('mouseleave', stopScrolling);
            rightSensor.addEventListener('mouseenter', () => startScrolling('right'));
            rightSensor.addEventListener('mouseleave', stopScrolling);
        }

        function scrollToLatest() {
            if (timeline) {
                setTimeout(() => { timeline.scrollLeft = timeline.scrollWidth; }, 100);
            }
        }

        const originalUpdateSlides = updateSlides;
        updateSlides = function(direction) {
            originalUpdateSlides(direction);
            if (currentSlide === 1) scrollToLatest();
        };

        // ===================================
        // 6. INISIALISASI CHART JS & ANIMASI
        // ===================================
        let responseChart;
        let satisfactionChart;
        const primaryColor = '#4f77ff'; 
        const secondaryColor = '#6c757d'; 

        // Fungsi Memutar Ulang Animasi
        function playChartAnimations() {
            if (responseChart && satisfactionChart) {
                // 1. Simpan nilai aktual yang didapat dari database
                const targetWaktu = responseChart.data.datasets[1].data[0] || 0;
                const targetPuas = satisfactionChart.data.datasets[0].data[0] || 0;
                const targetTidakPuas = satisfactionChart.data.datasets[0].data[1] || 100;

                // 2. Setel nilai grafik menjadi 0 (Tanpa animasi)
                responseChart.data.datasets[1].data = [0];
                satisfactionChart.data.datasets[0].data = [0, 100];
                responseChart.update('none');
                satisfactionChart.update('none');

                // 3. Beri jeda 100ms, lalu kembalikan ke nilai aktual (Akan memicu animasi)
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
                        animation: {
                            duration: 1500, // Durasi animasi 1.5 Detik
                            easing: 'easeOutQuart' // Animasi melambat di akhir
                        },
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
                        animation: {
                            duration: 1500, // Durasi animasi lingkaran 1.5 Detik
                            easing: 'easeOutQuart' 
                        },
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

            // Fungsi AJAX Real-Time dengan Deteksi Perubahan Data
            function updateMetricsRealtime() {
                fetch('get_metrics.php?t=' + new Date().getTime())
                    .then(response => {
                        if(!response.ok) throw new Error('Jaringan Error');
                        return response.json();
                    })
                    .then(data => {
                        // 1. Logika Update Bar Chart (Waktu Respons)
                        if (responseChart) {
                            // Ambil angka yang sedang tampil di grafik saat ini
                            let currentWaktu = responseChart.data.datasets[1].data[0];
                            
                            // Jika angka dari database BERBEDA dengan yang di grafik, maka animasikan!
                            if (currentWaktu !== data.waktu_amanin) {
                                responseChart.data.datasets[1].data = [data.waktu_amanin];
                                responseChart.data.datasets[1].label = `Respon AMANIN (${data.waktu_amanin} Menit)`;
                                responseChart.update(); // <-- Memanggil .update() tanpa 'none' memicu animasi transisi mulus
                            }
                        }

                        // 2. Logika Update Doughnut Chart (Kepuasan)
                        if (satisfactionChart) {
                            // Ambil persentase Puas yang sedang tampil saat ini
                            let currentPuas = satisfactionChart.data.datasets[0].data[0];
                            
                            // Jika persentase berubah, putar grafiknya!
                            if (currentPuas !== data.puas) {
                                satisfactionChart.data.datasets[0].data = [data.puas, data.tidak_puas];
                                satisfactionChart.data.labels = [`Puas (${data.puas}%)`, `Tidak Puas (${data.tidak_puas}%)`];
                                satisfactionChart.update(); // <-- Memicu animasi memutar
                            }
                        }
                    })
                    .catch(error => console.error('Gagal memuat data metrik:', error));
            }

            updateMetricsRealtime(); // Panggil pertama kali
            setInterval(updateMetricsRealtime, 3000); // Polling setiap 3 detik
        });
    </script>
</body>
</html>