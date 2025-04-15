<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda Arpusda</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

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
    <header class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-4 shadow-md">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center">
                <i class="fas fa-calendar-check text-2xl mr-2"></i>
                <h1 class="text-2xl font-bold">Agenda Arpusda</h1>
            </div>
            <div>
                <a href="{{ route('filament.admin.auth.login') }}" {{-- class="bg-white text-blue-600 px-3 py-2 rounded-md font-medium hover:bg-blue-50 transition-colors"> --}}
                    class="bg-white text-blue-600 px-3 py1.5 md:px-4 md:py-2 text-sm md:text-base rounded-md font-medium hover:bg-blue-50 transition-colors flex items-center">
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
    <footer class="bg-gray-800 text-white py-8 mt-16">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <h3 class="text-xl font-bold mb-2">Agenda Dinas Arpus</h3>
                    <p class="text-gray-300"> agenda kegiatan Dinas Arsip dan Perpustakaan Kota Semarang</p>
                </div>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-300 hover:text-white transition-colors">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-white transition-colors">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-white transition-colors">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
            <div class="mt-6 text-center border-t border-gray-700 pt-6">
                <p class="text-gray-400">&copy; {{ date('Y') }} IT | Arpusda All rights reserved.</p>
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

    @stack('scripts')
</body>

</html>
