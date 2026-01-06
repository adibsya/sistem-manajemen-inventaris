# 🏫 E-SIMS (Electronic School Inventory Management System)

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Alpine.js](https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpinedotjs&logoColor=white)
![Chart.js](https://img.shields.io/badge/Chart.js-F5788D?style=for-the-badge&logo=chartdotjs&logoColor=white)

**E-SIMS** adalah sistem manajemen inventaris modern yang dirancang untuk memudahkan pengelolaan aset, pelacakan kondisi barang, serta manajemen pemeliharaan dan laporan kerusakan secara efisien, responsif, dan *real-time*.

---

## 🚀 Fitur Utama

### 📦 Manajemen Aset Komprehensif
- **CRUD Asset:** Tambah, edit, dan hapus data aset dengan mudah.
- **Pelacakan Detail:** Simpan informasi kode, merek, tanggal beli, hingga kondisi aset.
- **Filter Canggih:** Cari aset berdasarkan kategori, ruangan, atau kondisi.
- **Export PDF:** Unduh laporan data aset dalam format PDF siap cetak.

### ⚠️ Pelaporan & Pemeliharaan
- **Laporan Kerusakan:** Sistem tiket untuk pelaporan aset rusak dengan bukti foto.
- **Tracking Status:** Pantau status laporan (*pending, process, fixed*).
- **Riwayat Perbaikan (Maintenance Logs):** Catat biaya dan tindakan perbaikan untuk transparansi anggaran.

### 📊 Dashboard Interaktif
- Visualisasi data aset dengan **Chart.js**.
- Statistik *real-time* kondisi aset dan biaya pemeliharaan.
- *Quick summary* untuk kategori dan ruangan.

### 📱 Mobile-First Design
- **UI Responsif:** Tampilan optimal di Smartphone, Tablet, dan Desktop.
- **Ergonomic UX:** Tombol aksi strategis (mudah dijangkau jari) untuk pengalaman mobile terbaik.
- **Clean Aesthetic:** Desain modern menggunakan Tailwind CSS.

### 👥 Manajemen Pengguna
- **Multi-Role:** Akses berbeda untuk Admin, Teknisi, dan User biasa.

---

## 🛠 Teknologi yang Digunakan

- **Backend:** Laravel Framework (PHP 8.2+)
- **Frontend:** Blade Templates, Tailwind CSS, Alpine.js
- **Database:** MySQL
- **Assets Bundling:** Vite
- **Reporting:** Laravel DomPDF
- **Visualization:** Chart.js

---

## ⚡ Optimasi Performa (High Performance)

Project ini telah dioptimasi untuk kecepatan dan skalabilitas tinggi:

1.  **Dashboard Caching** 🚀
    - Penggunaan Redis/File Cache untuk statistik dashboard (11 queries → 0 queries).
    - *Auto-clear cache* saat ada perubahan data.
    - Waktu muat dashboard **3-5x lebih cepat**.
2.  **Database Query Optimization** 🔍
    - Penerapan *Eager Loading* untuk mencegah masalah N+1 Query.
    - Indexing database untuk pencarian cepat.
3.  **Production Assets** 📦
    - Minified & Purged CSS/JS (ukuran file turun ~80% dibanding dev mode).
    - Optimized assets loading.

---

## 📦 Cara Instalasi

Ikuti langkah berikut untuk menjalankan project di lokal:

1.  **Clone Repository**
    ```bash
    git clone https://github.com/username/e-sims.git
    cd e-sims
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install
    ```

3.  **Setup Environment**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    *Sesuaikan konfigurasi database di file `.env`.*

4.  **Migrate & Seed Database**
    ```bash
    php artisan migrate --seed
    ```

5.  **Build Assets**
    ```bash
    npm run build
    ```

6.  **Jalankan Server**
    ```bash
    php artisan serve
    ```

Akses aplikasi di `http://localhost:8000`.

---

## 🤝 Kontribusi

Kontribusi selalu diterima! Silakan buat *Pull Request* atau laporkan *Issue* jika menemukan bug.

## 📄 Lisensi

Project ini open-source di bawah lisensi [MIT](https://opensource.org/licenses/MIT).
