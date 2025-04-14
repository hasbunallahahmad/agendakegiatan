<?php

namespace Database\Seeders;

use App\Models\Agenda;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Agenda::create([
            'title' => 'Rapat Koordinasi Tim',
            'description' => 'Rapat koordinasi tim untuk membahas progres project website manajemen agenda',
            'start_date' => Carbon::now()->setTime(9, 0),
            'end_date' => Carbon::now()->setTime(10, 30),
            'location' => 'Ruang Meeting Utama',
            'category' => 'meeting',
            'is_published' => true,
        ]);

        Agenda::create([
            'title' => 'Workshop Laravel 12',
            'description' => 'Workshop pengenalan fitur-fitur terbaru Laravel 12 dan implementasinya',
            'start_date' => Carbon::now()->setTime(13, 0),
            'end_date' => Carbon::now()->setTime(16, 0),
            'location' => 'Ruang Training',
            'category' => 'training',
            'is_published' => true,
        ]);

        Agenda::create([
            'title' => 'Presentasi Mockup UI/UX',
            'description' => 'Presentasi desain mockup UI/UX untuk aplikasi mobile',
            'start_date' => Carbon::now()->setTime(15, 30),
            'end_date' => Carbon::now()->setTime(17, 0),
            'location' => 'Ruang Presentasi',
            'category' => 'meeting',
            'is_published' => true,
        ]);

        Agenda::create([
            'title' => 'Sprint Planning',
            'description' => 'Perencanaan sprint mendatang untuk project e-commerce',
            'start_date' => Carbon::now()->addDays(1)->setTime(10, 0),
            'end_date' => Carbon::now()->addDays(1)->setTime(12, 0),
            'location' => 'Ruang Meeting Utama',
            'category' => 'meeting',
            'is_published' => true,
        ]);

        Agenda::create([
            'title' => 'Pelatihan Filament Admin',
            'description' => 'Pelatihan penggunaan Filament untuk admin panel Laravel',
            'start_date' => Carbon::now()->addDays(2)->setTime(9, 0),
            'end_date' => Carbon::now()->addDays(2)->setTime(17, 0),
            'location' => 'Ruang Training',
            'category' => 'training',
            'is_published' => true,
        ]);

        Agenda::create([
            'title' => 'Company Gathering',
            'description' => 'Acara gathering perusahaan untuk mempererat hubungan antar karyawan',
            'start_date' => Carbon::now()->addDays(5)->setTime(8, 0),
            'end_date' => Carbon::now()->addDays(5)->setTime(17, 0),
            'location' => 'Pantai Indah Resort',
            'category' => 'umum',
            'is_published' => true,
        ]);

        Agenda::create([
            'title' => 'Tech Talk: AI in Web Development',
            'description' => 'Pembahasan tentang implementasi AI dalam pengembangan web modern',
            'start_date' => Carbon::now()->addDays(7)->setTime(13, 0),
            'end_date' => Carbon::now()->addDays(7)->setTime(15, 0),
            'location' => 'Auditorium',
            'category' => 'umum',
            'is_published' => true,
        ]);

        Agenda::create([
            'title' => 'Code Review Session',
            'description' => 'Sesi review kode untuk project yang sedang berjalan',
            'start_date' => Carbon::now()->addDays(3)->setTime(14, 0),
            'end_date' => Carbon::now()->addDays(3)->setTime(16, 0),
            'location' => 'Ruang Dev Team',
            'category' => 'meeting',
            'is_published' => true,
        ]);

        Agenda::create([
            'title' => 'Interview Kandidat Developer',
            'description' => 'Sesi interview untuk posisi Full Stack Developer',
            'start_date' => Carbon::now()->addDays(4)->setTime(10, 0),
            'end_date' => Carbon::now()->addDays(4)->setTime(12, 0),
            'location' => 'Ruang Interview',
            'category' => 'meeting',
            'is_published' => false,
        ]);
    }
}
