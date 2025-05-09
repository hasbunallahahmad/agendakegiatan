<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda Arpusda</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': {
                            100: '#fee2e2', // merah soft light
                            200: '#fecaca',
                            300: '#fca5a5',
                            400: '#f87171',
                            500: '#ef4444', // merah soft medium
                            600: '#dc2626', // merah soft
                            700: '#b91c1c', // merah darker
                            800: '#991b1b',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!--AOS CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>


    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .agenda-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .agenda-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .real-time-clock {
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-gradient-to-r from-primary-500 to-primary-700 text-white py-4 shadow-md">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center">
                <i class="fas fa-calendar-check text-2xl mr-2"></i>
                <h1 class="text-2xl font-bold">Agenda Arpusda</h1>
            </div>
            <div>
                <a href="{{ route('filament.admin.auth.login') }}" target="_blank"
                    class="bg-white text-primary-600 px-3 py1.5 md:px-4 md:py-2 text-sm md:text-base rounded-md font-medium hover:bg-primary-50 transition-colors flex items-center">
                    <i class="fas fa-user-lock mr-1"></i> Login
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto px-4">
            <!-- Social media icons pada bagian atas -->
            <div class="flex justify-center mb-3">
                <div class="flex items-center space-x-3">
                    <a href="#" class="text-gray-400 hover:text-white text-sm" aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white text-sm" aria-label="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white text-sm" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>

            <!-- Teks di tengah -->
            <div class="text-center mb-2">
                <div class="flex items-center justify-center space-x-2">
                    <span class="text-sm font-medium">Agenda Dinas Arpus</span>
                    <span class="text-xs text-gray-400">|</span>
                    <span class="text-xs text-gray-400">Dinas Arsip dan Perpustakaan Kota Semarang</span>
                </div>
            </div>

            <!-- Copyright di bagian bawah -->
            <div class="text-center text-xs text-gray-400">
                &copy; 2025 IT | Arpusda All rights reserved.
            </div>
        </div>
    </footer>

    <!-- JavaScript untuk realtime clock -->
    <script>
        function updateDateTime() {
            const now = new Date();

            // Format tanggal: Senin, 14 April 2025
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const dateStr = now.toLocaleDateString('id-ID', options);

            // Format waktu: 14:30:45
            const timeStr = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });

            // Update elemen HTML
            document.getElementById('current-date').textContent = dateStr;
            document.getElementById('current-time').textContent = timeStr;
        }

        // Update setiap detik
        setInterval(updateDateTime, 1000);

        // Update awal saat halaman dimuat
        updateDateTime();
    </script>

    <!-- Initialize AOS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 1000,
                once: false,
                mirror: true,
                easing: 'ease-in-out',
                offset: 120
            });
        });
    </script>
    <button id="backToTopBtn"
        class="fixed bottom-24 md:bottom-28 right-5 bg-primary-600 hover:bg-primary-700 text-white rounded-full p-3 shadow-lg transition-all duration-300 opacity-0 invisible z-50"
        aria-label="Kembali ke atas">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil referensi tombol back to top
            const backToTopBtn = document.getElementById('backToTopBtn');

            const footer = document.querySelector('footer');

            // Fungsi untuk mengecek posisi scroll relatif terhadap footer
            function toggleBackToTopButton() {
                // Dapatkan posisi footer dari atas halaman
                const footerPosition = footer.getBoundingClientRect().top;
                // Dapatkan tinggi viewport
                const windowHeight = window.innerHeight;

                // Tombol muncul saat footer hampir terlihat (300px sebelum footer)
                if (footerPosition < windowHeight + 50) {
                    // Tampilkan tombol
                    backToTopBtn.classList.remove('opacity-0', 'invisible');
                    backToTopBtn.classList.add('opacity-100', 'visible');
                } else {
                    // Sembunyikan tombol
                    backToTopBtn.classList.remove('opacity-100', 'visible');
                    backToTopBtn.classList.add('opacity-0', 'invisible');
                }
            }

            // Tambahkan event listener untuk scroll
            window.addEventListener('scroll', toggleBackToTopButton);

            // Tambahkan event listener untuk klik tombol
            backToTopBtn.addEventListener('click', function() {
                // Scroll ke atas dengan animasi
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // Inisialisasi status tombol saat halaman dimuat
            toggleBackToTopButton();
        });
    </script>
    @stack('scripts')
</body>

</html>
