<?php

namespace Database\Seeders;

use App\Models\Bidang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bidangs = [
            ['nama_bidang' => 'Keuangan dan Aset', 'deskripsi' => 'Keuangan dan Aset'],
            ['nama_bidang' => 'Umpeg', 'deskripsi' => 'Umum dan Kepegawaian'],
            ['nama_bidang' => 'Perencanaan', 'deskripsi' => 'Perencanaan dan Evaluasi'],
            ['nama_bidang' => 'Arsip 1', 'deskripsi' => 'Bidang Arsip 1'],
            ['nama_bidang' => 'Arsip 2', 'deskripsi' => 'Bidang Arsip 2'],
            ['nama_bidang' => 'Perpus 1', 'deskripsi' => 'Bidang Perpus 1'],
            ['nama_bidang' => 'Perpus 2', 'deskripsi' => 'Bidang Perpus 2'],
        ];

        foreach ($bidangs as $bidang) {
            Bidang::create($bidang);
        }
    }
}
