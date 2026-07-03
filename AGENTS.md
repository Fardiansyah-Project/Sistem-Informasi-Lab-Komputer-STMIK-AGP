# Agent Instructions & Developer Guide

File ini berisi instruksi spesifik untuk AI Agent atau asisten developer saat membantu proses pengembangan maupun *troubleshooting* sistem SILAB.

## 1. Aturan Penulisan Kode (Coding Standards)
* **Penamaan Database:** Gunakan format jamak (plural) dalam bahasa inggris agar rapi dan format ber-snake_case untuk tabel (`inventories`, `proposals`, `detail_proposals`).
* **Model Eloquent:** Pastikan relasi didefinisikan dengan jelas menggunakan petunjuk tipe pengembalian (return types), contoh: `public function details(): HasMany`.
* **Kerapian Tailwind:** Hindari penumpukan class berlebih yang membuat kode sulit dibaca. Kelompokkan utilitas atau gunakan komponen parsial Blade untuk elemen berulang (seperti baris tabel atau form group).

## 2. Struktur Penting yang Harus Dijaga
Saat memodifikasi fitur pengajuan barang, pastikan komponen kopsurat di bawah ini selalu merujuk pada aset gambar statis yang terletak di `public/img/kop_surat.jpg` untuk menjamin keaslian visual dokumen STMIK Adhi Guna:

```html
<div class="w-full flex justify-center mb-4">
    <img src="{{ asset('img/kop_surat.jpg') }}" alt="Kop Surat STMIK Adhi Guna" class="w-full h-auto">
</div>