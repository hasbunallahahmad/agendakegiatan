@extends('layouts.app')

@section('content')
    <!-- Hero Section dengan Jam Real-time -->
    {{-- <section class="bg-gradient-to-r from-primary-500 to-primary-600 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <div class="real-time-clock mb-8" data-aos="zoom-in" data-aos-duration="1200">
                <div id="current-date" class="text-2xl md:text-3xl font-light mb-2"></div>
                <div id="current-time" class="text-5xl md:text-6xl font-bold"></div>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold mb-4" data-aos="fade-up" data-aos-delay="200">Selamat Datang di Agenda
                Kegiatan</h2>
            <p class="text-xl md:text-2xl max-w-3xl mx-auto opacity-90" data-aos="fade-up" data-aos-delay="400">Dinas Arsip
                dan Perpustakaan Kota Semarang</p>
        </div>
    </section> --}}

    <section class="relative h-[325px] overflow-hidden">
        <!-- Image Slider -->
        <div class="slider-container absolute inset-0 w-full h-full">
            <div class="slider-container absolute inset-0 w-full h-full">
                <div class="slider-image active bg-cover bg-center h-full w-full transition-opacity duration-1000"
                    style="background-image: url('{{ asset('images/semarang.jpg') }}');" data-alt="Semarang City"></div>
                <div class="slider-image bg-cover bg-center h-full w-full transition-opacity duration-1000 opacity-0"
                    style="background-image: url('{{ asset('images/kotalama.jpg') }}');" data-alt="Kota Lama Semarang"></div>
                <div class="slider-image bg-cover bg-center h-full w-full transition-opacity duration-1000 opacity-0"
                    style="background-image: url('{{ asset('images/tugumuda.jpeg') }}');" data-alt="Tugu Muda Semarang">
                </div>
                <div class="slider-image bg-cover bg-center h-full w-full transition-opacity duration-1000 opacity-0"
                    style="background-image: url('{{ asset('images/dinas.jpeg') }}');"
                    data-alt="Dinas Arsip dan Perpustakaan"></div>
            </div>
        </div>

        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-primary-100/80 to-primary-200/80"></div>

        <!-- Content -->
        <div class="container relative z-10 mx-auto px-4 h-full flex items-center">
            <div class="text-center w-full text-white">
                <div class="real-time-clock mb-8" data-aos="zoom-in" data-aos-duration="1200">
                    <div id="current-date" class="text-2xl md:text-3xl font-light mb-2"></div>
                    <div id="current-time" class="text-5xl md:text-6xl font-bold"></div>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold mb-4" data-aos="fade-up" data-aos-delay="200">Selamat Datang di
                    Agenda Kegiatan</h2>
                <p class="text-xl md:text-2xl max-w-3xl mx-auto opacity-90" data-aos="fade-up" data-aos-delay="400">Dinas
                    Arsip dan Perpustakaan Kota Semarang</p>
            </div>
        </div>
    </section>

    <style>
        .slider-image {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            transition: opacity .5s ease-in-out;
        }

        .slider-image.active {
            opacity: 1;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Slider functionality
            const sliderImages = document.querySelectorAll('.slider-image');
            const sliderDots = document.querySelectorAll('.slider-dot');
            let currentSlide = 0;

            // Initialize slider
            function initSlider() {
                // Show first slide
                sliderImages[0].classList.add('active');

                // Auto slide
                setInterval(nextSlide, 2500);
            }
            // Go to next slide
            function nextSlide() {
                sliderImages[currentSlide].classList.remove('active');
                currentSlide = (currentSlide + 1) % sliderImages.length;
                sliderImages[currentSlide].classList.add('active');
            }
            // Initialize slider
            initSlider();
        });
    </script>

    <!-- Today Agenda Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between mb-8" data-aos="fade-right">
                <h2 class="text-3xl font-bold text-gray-800">
                    <i class="fas fa-calendar-day text-primary-500 mr-2"></i>
                    Agenda Hari Ini
                </h2>
                <div class="bg-primary-100 text-white-800 font-medium px-4 py-2 rounded-full" data-aos="fade-left">
                    {{ now()->translatedFormat('d M Y') }}
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($todayAgendas as $agenda)
                    <div class="agenda-card bg-white rounded-lg overflow-hidden shadow-md border border-gray-100"
                        data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}" data-aos-duration="800">
                        <div class="bg-blue-50 px-6 py-3 border-b border-primary-100">
                            <div class="flex items-center">
                                <div
                                    class="bg-primary-500 text-white rounded-lg w-12 h-12 flex items-center justify-center mr-3">
                                    <span class="font-bold text-lg">{{ $agenda->start_date->format('d') }}</span>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-600">
                                        {{ $agenda->start_date->translatedFormat('M Y') }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        @if ($agenda->is_multi_day)
                                            <span
                                                class="bg-primary-100 text-primary-700 px-2 py-0.5 rounded-full text-xs">Multi-day</span>
                                        @else
                                            {{ $agenda->start_date->translatedFormat('l') }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-xl font-semibold text-gray-800">{{ $agenda->title }}</h3>
                            </div>

                            @if ($agenda->description)
                                <p class="text-gray-600 mb-4">{{ Str::limit($agenda->description, 250) }}</p>
                            @endif

                            <div class="flex flex-col space-y-2">
                                @if ($agenda->bidang->count() > 0)
                                    <div class="flex items-center text-gray-500">
                                        <i class="fas fa-user mr-2 text-primary-500"></i>
                                        <span>
                                            @foreach ($agenda->bidang as $bidang)
                                                {{ $bidang->nama_bidang }}@if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                        </span>
                                    </div>
                                @endif

                                {{-- <div class="flex items-center text-gray-500">
                                    <i class="fas fa-calendar mr-2 text-primary-500"></i>
                                    <span>
                                        @if ($agenda->is_multi_day)
                                            {{ $agenda->date_range }}
                                        @else
                                            {{ $agenda->start_date->translatedFormat('d M Y') }}
                                        @endif
                                    </span>
                                </div> --}}

                                <div class="flex items-center text-gray-500">
                                    <i class="fas fa-clock mr-2 text-primary-500"></i>
                                    <span>
                                        {{ $agenda->start_date->format('H:i') }}
                                        @if ($agenda->end_date)
                                            - {{ $agenda->end_date->format('H:i') }}
                                        @endif
                                    </span>
                                </div>

                                @if ($agenda->location)
                                    <div class="flex items-center text-gray-500">
                                        <i class="fas fa-map-marker-alt mr-2 text-primary-500"></i>
                                        <span>{{ $agenda->location }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                        <div class="col-span-full text-center py-12" data-aos="fade-up">
                            <div class="mx-auto w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-calendar-xmark text-4xl text-primary-300"></i>
                            </div>
                            <h3 class="text-xl font-medium text-gray-700 mb-2">Tidak Ada Agenda Hari Ini</h3>
                            <p class="text-gray-500">Tidak ada agenda yang terjadwal untuk hari ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>


        <!-- Upcoming Agenda Section -->
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between mb-8" data-aos="fade-right">
                    <h2 class="text-3xl font-bold text-gray-800">
                        <i class="fas fa-calendar-plus text-primary-500 mr-2"></i>
                        Agenda Mendatang
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @php
                        // Buat array untuk menyimpan agenda yang diproses per hari
                        $expandedAgendas = [];

                        // Loop melalui agenda mendatang
                        foreach ($upcomingAgendas as $agenda) {
                            // Jika multi-day, buat entri untuk setiap hari dalam rentang
                            if ($agenda->is_multi_day && $agenda->end_date) {
                                $startDate = $agenda->start_date->copy();
                                $endDate = $agenda->end_date->copy();

                                // Buat rentang tanggal dari tanggal mulai hingga tanggal selesai
                                $currentDate = $startDate->copy();
                                while ($currentDate->lte($endDate)) {
                                    // Skip hari ini karena sudah ditampilkan di Today Agenda
                                    if (!$currentDate->isToday()) {
                                        // Buat salinan agenda untuk tanggal ini
                                        $dailyAgenda = clone $agenda;
                                        // Set tanggal display untuk tampilan
                                        $dailyAgenda->display_date = $currentDate->copy();
                                        $expandedAgendas[] = $dailyAgenda;
                                    }
                                    $currentDate->addDay();
                                }
                            }
                            // Jika bukan multi-day, tambahkan langsung
                            else {
                                // Skip jika tanggalnya hari ini
                                if (!$agenda->start_date->isToday()) {
                                    $agenda->display_date = $agenda->start_date->copy();
                                    $expandedAgendas[] = $agenda;
                                }
                            }
                        }

                        // Urutkan berdasarkan tanggal display
                        usort($expandedAgendas, function ($a, $b) {
                            return $a->display_date->lt($b->display_date) ? -1 : 1;
                        });
                    @endphp

                    @forelse($expandedAgendas as $agenda)
                        <div class="agenda-card bg-white rounded-lg overflow-hidden shadow-md border border-gray-100"
                            data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}" data-aos-duration="800">
                            <div class="bg-blue-50 px-6 py-3 border-b border-primary-100">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div
                                            class="bg-primary-500 text-white rounded-lg w-12 h-12 flex items-center justify-center mr-3">
                                            <span class="font-bold text-lg">{{ $agenda->display_date->format('d') }}</span>
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-600">
                                                {{ $agenda->display_date->translatedFormat('M Y') }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                @if ($agenda->is_multi_day)
                                                    <span
                                                        class="bg-primary-100 text-primary-700 px-2 py-0.5 rounded-full text-xs">
                                                        Multi-day (Hari
                                                        ke-{{ $agenda->start_date->diffInDays($agenda->display_date) + 1 }})
                                                    </span>
                                                @else
                                                    {{ $agenda->display_date->translatedFormat('l') }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <h3 class="text-xl font-semibold text-gray-800">{{ $agenda->title }}</h3>
                                </div>

                                @if ($agenda->description)
                                    <p class="text-gray-600 mb-4">{{ Str::limit($agenda->description, 250) }}</p>
                                @endif

                                <div class="flex flex-col space-y-2">
                                    @if ($agenda->bidang->count() > 0)
                                        <div class="flex items-center text-gray-500">
                                            <i class="fas fa-user mr-2 text-primary-500"></i>
                                            <span>
                                                @foreach ($agenda->bidang as $bidang)
                                                    {{ $bidang->nama_bidang }}@if (!$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach
                                            </span>
                                        </div>
                                    @endif

                                    <div class="flex items-center text-gray-500">
                                        {{-- <i class="fas fa-calendar mr-2 text-primary-500"></i> --}}
                                        <span class="font-medium">
                                            @if ($agenda->is_multi_day)
                                                {{-- {{ $agenda->date_range }}
                                                {{-- <span class="text-sm text-primary-600 ml-1">(Hari ini:
                                                    {{ $agenda->display_date->translatedFormat('d M Y') }})</span> --}}
                                            @else
                                                {{-- {{ $agenda->display_date->translatedFormat('d M Y') }} --}}
                                            @endif
                                        </span>
                                    </div>

                                    <div class="flex items-center text-gray-500">
                                        <i class="fas fa-clock mr-2 text-primary-500"></i>
                                        <span>
                                            {{ $agenda->start_date->format('H:i') }}
                                            @if ($agenda->end_date)
                                                - {{ $agenda->end_date->format('H:i') }}
                                            @endif
                                        </span>
                                    </div>

                                    @if ($agenda->location)
                                        <div class="flex items-center text-gray-500">
                                            <i class="fas fa-map-marker-alt mr-2 text-primary-500"></i>
                                            <span>{{ $agenda->location }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @empty
                            <div class="col-span-full text-center py-12" data-aos="fade-up">
                                <div class="mx-auto w-24 h-24 bg-primary-50 rounded-full flex items-center justify-center mb-4">
                                    <i class="fas fa-calendar-week text-4xl text-primary-300"></i>
                                </div>
                                <h3 class="text-xl font-medium text-gray-700 mb-2">Tidak Ada Agenda Mendatang</h3>
                                <p class="text-gray-500">Belum ada agenda yang dijadwalkan untuk hari-hari mendatang.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>

            <!-- Call to Action Section -->
            <section class="py-8 bg-white">
                <div class="container mx-auto px-4 text-center">
                    <div class="max-w-2xl mx-auto" data-aos="fade-up" data-aos-offset="200">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">Butuh informasi lebih lanjut?</h2>
                        <p class="text-gray-600 mb-4">Jika Anda memiliki pertanyaan tentang agenda, silakan hubungi kami.</p>
                        <div class="flex flex-wrap justify-center gap-3">
                            <a href="https://api.whatsapp.com/send/?phone=6282241407907&text&type=phone_number&app_absent=0"
                                class="bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium py-2 px-4 rounded transition-colors"
                                data-aos="zoom-in" data-aos-delay="100">
                                <i class="fas fa-envelope mr-1"></i> Kontak Kami
                            </a>
                            {{-- <a href="{{ route('filament.admin.auth.login') }}" target="_blank"
                                class="bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm font-medium py-2 px-4 rounded transition-colors"
                                data-aos="zoom-in" data-aos-delay="200">
                                <i class="fas fa-user mr-1"></i> Area Admin
                            </a> --}}
                        </div>
                    </div>
                </div>
            </section>
        @endsection

        @push('scripts')
            <script>
                // Fungsi untuk menampilkan jam real-time
                function updateClock() {
                    const now = new Date();

                    // Format tanggal
                    const options = {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    };
                    const dateStr = now.toLocaleDateString('id-ID', options);

                    // Format waktu
                    const timeStr = now.toLocaleTimeString('id-ID', {
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit',
                        hour12: false
                    });

                    // Update elemen HTML
                    document.getElementById('current-date').textContent = dateStr;
                    document.getElementById('current-time').textContent = timeStr;
                }

                // Update jam setiap detik
                document.addEventListener('DOMContentLoaded', function() {
                    updateClock(); // Jalankan sekali saat halaman dimuat
                    setInterval(updateClock, 1000); // Update setiap detik
                });

                // Refresh AOS on window resize
                window.addEventListener('resize', function() {
                    AOS.refresh();
                });
            </script>
        @endpush
