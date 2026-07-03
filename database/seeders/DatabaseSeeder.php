<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Laboratory;
use App\Models\Inventory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Admin User
        $user = User::create([
            'name' => 'Kepala UPT Lab',
            'nidn' => '0912345678',
            'email' => 'admin@stmik-adhiguna.ac.id',
            'password' => Hash::make('password'),
        ]);

        // Seed Laboratorium
        $labHardware = Laboratory::create([
            'nama_lab' => 'Lab Hardware',
            'lokasi' => 'Gedung A - Lantai 1',
        ]);

        $labSoftware = Laboratory::create([
            'nama_lab' => 'Lab Software',
            'lokasi' => 'Gedung A - Lantai 2',
        ]);

        $labJaringan = Laboratory::create([
            'nama_lab' => 'Lab Jaringan',
            'lokasi' => 'Gedung B - Lantai 1',
        ]);

        // Seed Inventaris - Lab Hardware
        $hardwareItems = [
            ['kode_barang' => 'HW-001', 'nama_barang' => 'Komputer Desktop (PC)', 'jumlah' => 20, 'kondisi' => 'Baik'],
            ['kode_barang' => 'HW-002', 'nama_barang' => 'Monitor LED 24"', 'jumlah' => 20, 'kondisi' => 'Baik'],
            ['kode_barang' => 'HW-003', 'nama_barang' => 'Keyboard USB', 'jumlah' => 18, 'kondisi' => 'Baik'],
            ['kode_barang' => 'HW-004', 'nama_barang' => 'Mouse Optical', 'jumlah' => 15, 'kondisi' => 'Baik'],
            ['kode_barang' => 'HW-005', 'nama_barang' => 'Motherboard ASUS', 'jumlah' => 3, 'kondisi' => 'Rusak'],
            ['kode_barang' => 'HW-006', 'nama_barang' => 'Power Supply 500W', 'jumlah' => 2, 'kondisi' => 'Rusak'],
        ];

        foreach ($hardwareItems as $item) {
            Inventory::create(array_merge($item, ['laboratorium_id' => $labHardware->id]));
        }

        // Seed Inventaris - Lab Software
        $softwareItems = [
            ['kode_barang' => 'SW-001', 'nama_barang' => 'Komputer Desktop (PC)', 'jumlah' => 25, 'kondisi' => 'Baik'],
            ['kode_barang' => 'SW-002', 'nama_barang' => 'Monitor LED 24"', 'jumlah' => 25, 'kondisi' => 'Baik'],
            ['kode_barang' => 'SW-003', 'nama_barang' => 'Proyektor Epson', 'jumlah' => 1, 'kondisi' => 'Baik'],
            ['kode_barang' => 'SW-004', 'nama_barang' => 'Headset Audio', 'jumlah' => 5, 'kondisi' => 'Rusak'],
        ];

        foreach ($softwareItems as $item) {
            Inventory::create(array_merge($item, ['laboratorium_id' => $labSoftware->id]));
        }

        // Seed Inventaris - Lab Jaringan
        $networkItems = [
            ['kode_barang' => 'NW-001', 'nama_barang' => 'Switch Cisco 24-Port', 'jumlah' => 5, 'kondisi' => 'Baik'],
            ['kode_barang' => 'NW-002', 'nama_barang' => 'Router MikroTik', 'jumlah' => 3, 'kondisi' => 'Baik'],
            ['kode_barang' => 'NW-003', 'nama_barang' => 'Kabel UTP Cat6 (box)', 'jumlah' => 10, 'kondisi' => 'Baik'],
            ['kode_barang' => 'NW-004', 'nama_barang' => 'Crimping Tool', 'jumlah' => 8, 'kondisi' => 'Baik'],
            ['kode_barang' => 'NW-005', 'nama_barang' => 'Access Point TP-Link', 'jumlah' => 2, 'kondisi' => 'Rusak'],
        ];

        foreach ($networkItems as $item) {
            Inventory::create(array_merge($item, ['laboratorium_id' => $labJaringan->id]));
        }
    }
}
