# Product Requirement Document (PRD) - SILAB
**Nama Sistem:** Sistem Informasi Manajemen UPT Laboratorium Komputer  
**Institusi:** STMIK Adhi Guna  

## 1. Latar Belakang
UPT Laboratorium Komputer memerlukan sistem terintegrasi untuk mendata inventaris barang secara berkala guna meminimalkan kesalahan pencatatan manual. Selain itu, proses pengajuan pengadaan barang sering kali memerlukan pembuatan surat birokrasi fisik yang repetitif. Sistem ini dibuat untuk mengotomatisasi pendataan sekaligus menyediakan fitur cetak surat permohonan resmi secara instan.

## 2. Tujuan Berorientasi Pengguna
* Mempermudah Kepala UPT dan staf dalam melacak status dan kondisi barang di setiap laboratorium (misal: Lab Hardware).
* Mengotomatisasi pembuatan dokumen formal "Surat Permohonan Pengadaan Barang" sesuai format institusi.
* Menyediakan fitur pelaporan terpilah untuk kebutuhan audit internal semesteran.

## 3. Ruang Lingkup Fitur
### 1. Manajemen Inventaris Barang
* CRUD Data Barang (Kode, Nama, Jumlah, Lokasi Lab, Kondisi: Baik/Rusak).
* Filter inventaris berdasarkan ruangan lab komputer.

### 2. Laporan Pengajuan Barang
* Formulir pembuatan surat pengajuan baru (Nomor surat, Perihal, Lampiran, Tanggal, dan daftar item dinamis).
* Sistem pelacakan status pengajuan (Pending, Disetujui, Ditolak).
* Cetak Surat Permohonan Pengadaan Barang (Format cetak presisi menggunakan Kop Surat resmi).

### 3. Sub-Modul Laporan
* **Laporan Inventaris:** Rekapitulasi total aset per laboratorium beserta kondisinya.
* **Laporan Pengajuan:** Rekapitulasi riwayat pengadaan barang berdasarkan rentang waktu tertentu.

## 4. Kriteria Keberhasilan (Success Criteria)
* Pengguna dapat menghasilkan dokumen cetak surat permohonan pengadaan barang dalam bentuk PDF/Print-ready view dalam waktu kurang dari 5 detik.
* Cetakan fisik surat harus presisi dan sesuai tata letak birokrasi STMIK Adhi Guna.