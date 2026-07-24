# Tech Stack & Spesifikasi Lingkungan Pengembangan

Proyek ini dibangun menggunakan kombinasi teknologi modern, andal, dan berorientasi pada kecepatan pengembangan serta kemudahan pemeliharaan (_maintainability_).

## 1. Core Stack

- **Framework Backend:** Laravel 11.x (PHP 8.2+)
- **Framework Frontend / Styling:** TailwindCSS v3.x / v4.x
- **Database Management System:** MySQL 8.0+

## 2. Dependensi & Driver Utama (Laravel Package)

- **Sistem Otentikasi:** Laravel Breeze atau Laravel Livewire (Opsional untuk interaksi form dinamis tanpa reload halaman).
- **Manipulasi Tanggal:** Carbon (Bawaan Laravel) untuk translasi format penanggalan lokal Indonesia (Contoh: `08 Mei 2026`).

## 3. Alasan Pemilihan Stack

- **Laravel & MySQL:** Ideal untuk manajemen relasi data kompleks (seperti relasi _One-to-Many_ antara surat pengajuan dan detail item barangnya) melalui sistem ORM Eloquent yang kuat.
- **TailwindCSS:** Memudahkan kontrol penuh atas desain halaman cetak korporat melalui utility classes, sehingga pengembang tidak perlu bergantung pada library PDF pihak ketiga (seperti DomPDF) yang sering mengalami kendala render CSS modern. Cukup gunakan fitur cetak native browser (`window.print()`).
