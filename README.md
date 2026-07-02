# Dokumentasi Install Project Laravel dari Clone GitHub

## 1. Clone Repository dari GitHub

Buka terminal atau CMD, lalu jalankan perintah berikut:

```bash
git clone https://github.com/nama-user/nama-project.git
```

Contoh:

```bash
git clone https://github.com/Fardiansyah-Project/Sistem-Informasi-Lab-Komputer-STMIK-AGP.git
```

Masuk ke folder project:

```bash
cd nama-project
```

---

## 2. Install Dependency Laravel

Jalankan perintah berikut untuk menginstall semua dependency Laravel menggunakan Composer:

```bash
composer install
```

Tunggu hingga proses selesai.

---

## 3. Copy File Environment

Salin file `.env.example` menjadi `.env`

### Windows

```bash
copy .env.example .env
```

### Linux / Mac

```bash
cp .env.example .env
```

---

## 4. Generate Application Key

Jalankan perintah berikut:

```bash
php artisan key:generate
```

Jika berhasil akan muncul:

```bash
Application key set successfully.
```

---

## 5. Atur Koneksi Database

Buka file `.env`, lalu ubah bagian database sesuai database yang digunakan.

Contoh:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_lab
DB_USERNAME=root
DB_PASSWORD=
```

---

## 6. Buat Database

Buka phpMyAdmin atau MySQL lalu buat database baru.

Contoh nama database:

```text
db_lab
```

---

## 7. Jalankan Migration

Jalankan perintah berikut untuk membuat tabel database:

```bash
php artisan migrate
```

Jika project memiliki seeder:

```bash
php artisan db:seed
```

Atau:

```bash
php artisan migrate --seed
```

---

## 8. Jalankan Project Laravel

Gunakan perintah berikut:

```bash
php artisan serve
```

Buka browser lalu akses:

```text
http://localhost:8000
```

---

# Persyaratan Sebelum Install

Pastikan perangkat sudah terinstall:

- PHP
- Composer
- MySQL / MariaDB
- Git
- Laravel

---

# Penutup

Dengan mengikuti langkah-langkah di atas, project Laravel yang berasal dari GitHub dapat dijalankan di komputer lokal dengan benar. Pastikan seluruh dependency berhasil diinstall dan konfigurasi database sesuai agar aplikasi dapat berjalan tanpa error.
