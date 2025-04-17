@extends('layouts.app')

@section('content')
    <!-- Hero Section dengan Jam Real-time -->
    <section class="bg-gradient-to-r from-primary-500 to-primary-600 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <div class="real-time-clock mb-8">
                <div id="current-date" class="text-2xl md:text-3xl font-light mb-2"></div>
                <div id="current-time" class="text-5xl md:text-6xl font-bold"></div>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Selamat Datang di Agenda Kegiatan</h2>
            <p class="text-xl md:text-2xl max-w-3xl mx-auto opacity-90">Dinas Arsip dan Perpustakaan Kota Semarang</p>
        </div>
    </section>

    <!-- Today Agenda Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-bold text-gray-800">
                    <i class="fas fa-calendar-day text-primary-500 mr-2"></i>
                    Agenda Hari Ini
                </h2>
                <div class="bg-blue-100 text-primary-800 font-medium px-4 py-2 rounded-full">
                    {{ now()->format('d M Y') }}
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($todayAgendas as $agenda)
                    <div class="agenda-card bg-white rounded-lg overflow-hidden shadow-md border border-gray-100">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-xl font-semibold text-gray-800">{{ $agenda->title }}</h3>
                            </div>

                            @if ($agenda->description)
                                <p class="text-gray-600 mb-4">{{ Str::limit($agenda->description, 50) }}</p>
                            @endif

                            <div class="flex flex-col space-y-2">
                                @if ($agenda->bidang)
                                    <div class="flex items-center text-gray-500">
                                        <i class="fas fa-user mr-2 text-primary-500"></i>
                                        <span>{{ $agenda->bidang->nama_bidang }}</span>
                                    </div>
                                @endif

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
                    <div class="col-span-full text-center py-12">
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
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-bold text-gray-800">
                    <i class="fas fa-calendar-plus text-primary-500 mr-2"></i>
                    Agenda Mendatang
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($upcomingAgendas as $agenda)
                    <div class="agenda-card bg-white rounded-lg overflow-hidden shadow-md border border-gray-100">
                        <div class="bg-blue-50 px-6 py-3 border-b border-primary-100">
                            <div class="flex items-center">
                                <div
                                    class="bg-primary-500 text-white rounded-lg w-12 h-12 flex items-center justify-center mr-3">
                                    <span class="font-bold text-lg">{{ $agenda->start_date->format('d') }}</span>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-600">{{ $agenda->start_date->format('M Y') }}</div>
                                    <div class="text-sm text-gray-500">{{ $agenda->start_date->format('l') }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-xl font-semibold text-gray-800">{{ $agenda->title }}</h3>
                            </div>

                            @if ($agenda->description)
                                <p class="text-gray-600 mb-4">{{ Str::limit($agenda->description, 50) }}</p>
                            @endif

                            <div class="flex flex-col space-y-2">
                                @if ($agenda->bidang)
                                    <div class="flex items-center text-gray-500">
                                        <i class="fas fa-user mr-2 text-primary-500"></i>
                                        <span>{{ $agenda->bidang->nama_bidang }}</span>
                                    </div>
                                @endif

                                {{-- <div class="flex flex-col space-y-2"> --}}
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
                    <div class="col-span-full text-center py-12">
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
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 text-center">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Butuh informasi lebih lanjut?</h2>
                <p class="text-xl text-gray-600 mb-8">Jika Anda memiliki pertanyaan atau membutuhkan informasi lebih lanjut
                    tentang agenda, silakan hubungi kami.</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="https://api.whatsapp.com/send/?phone=6282241407907&text&type=phone_number&app_absent=0"
                        class="bg-primary-600 hover:bg-primary-700 text-white font-medium py-3 px-6 rounded-lg shadow-md transition-colors">
                        <i class="fas fa-envelope mr-2"></i> Kontak Kami
                    </a>
                    <a href="{{ route('filament.admin.auth.login') }}" target="_blank"
                        class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium py-3 px-6 rounded-lg shadow-md transition-colors">
                        <i class="fas fa-user mr-2"></i> Area Admin
                    </a>
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
    </script>
@endpush
