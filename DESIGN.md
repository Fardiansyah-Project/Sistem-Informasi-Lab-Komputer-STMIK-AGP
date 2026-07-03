# Design Guidelines - Modern & Simple UI

Dokumentasi ini mengatur aspek visual sistem SILAB. Mengusung konsep **Modern Sederhana**, antarmuka difokuskan pada kebersihan ruang (*whitespace*), tipografi yang kuat, serta layout yang intuitif agar pengguna tidak lelah saat melakukan input data inventaris yang banyak.

## 1. Palet Warna (TailwindCSS Config)
Menggunakan pendekatan profesional bernuansa institusional namun tetap modern:
* **Primary (Slate Blue):** `bg-slate-900` & `text-slate-900` (Untuk kesederhanaan modern menggantikan warna hitam pekat).
* **Secondary / Accent:** `bg-indigo-600` (Untuk tombol utama/CTA, memberikan kesan teknologi).
* **Background:** `bg-slate-50` / `bg-gray-50` (Dasar aplikasi bersih, kontras tinggi).
* **Status Colors:** 
  * Sukses/Baik: `text-emerald-600` / `bg-emerald-50`
  * Rusak/Ditolak: `text-rose-600` / `bg-rose-50`

## 2. Tata Letak (Layout)
* **Dashboard Layout:** Menggunakan *Fixed Sidebar* tipis di sebelah kiri untuk navigasi utama (Dashboard, Inventaris, Pengajuan, Laporan) dan area konten utama yang responsif di sisi kanan.
* **Tabel Data:** Desain minimalis tanpa border vertikal yang kaku, menggunakan padding yang lega (`px-6 py-4`), serta efek `hover:bg-slate-50` untuk baris data agar mudah dibaca.
* **Formulir Dinamis:** Form untuk menambahkan barang pada pengajuan menggunakan komponen *inline card* beralur vertikal agar pengisian data terasa runtut dan ringkas.

## 3. Komponen Cetak Khusus (Print Layout)
Untuk halaman cetak surat permohonan pengadaan barang:
* Mengisolasi elemen web menggunakan class `print:hidden` pada sidebar, navbar, dan tombol aksi.
* Memaksa font kembali ke jenis Serif klasik (`font-serif`) khusus pada dokumen surat agar tampak formal, sedangkan aplikasi web menggunakan Sans-serif (`font-sans`).
* Menjaga ukuran lebar kertas agar pas pada rasio cetak A4/F4 standar.