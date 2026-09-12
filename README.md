# Infra Portal

Infra Portal adalah aplikasi web berbasis Laravel yang dirancang dengan performa tinggi menggunakan [FrankenPHP](https://frankenphp.dev/). Proyek ini sepenuhnya menggunakan Docker untuk mempermudah proses pengembangan lokal (local development) yang mencakup PostgreSQL untuk basis data, Redis untuk caching dan antrean (queues), serta Vite untuk manajemen aset frontend.

## 📦 Prasyarat

Sebelum memulai, pastikan sistem Anda telah terpasang:
- [Docker](https://www.docker.com/products/docker-desktop/) & Docker Compose
- `make` (opsional, namun sangat disarankan untuk kemudahan eksekusi perintah)

## 🚀 Langkah Setup (Instalasi)

1. **Salin file environment**  
   Gandakan file `.env.example` menjadi `.env`.
   ```bash
   cp .env.example .env
   ```
   *Anda dapat menyesuaikan konfigurasi di dalam `.env` jika diperlukan (seperti kredensial database).*

2. **Jalankan Setup Awal**  
   Proyek ini memiliki `Makefile` yang menyederhanakan proses setup. Jalankan perintah berikut untuk mem-build image Docker, menjalankan container, membuat `APP_KEY`, dan menjalankan migrasi database:
   ```bash
   make setup
   ```
   *(Jika Anda tidak memiliki `make`, Anda dapat menjalankan: `docker compose up -d --build`, lalu `docker compose exec app php artisan key:generate` dan `docker compose exec app php artisan migrate`).*

3. **Install Dependensi PHP (Composer)**  
   Dikarenakan volume host di-mount ke dalam container, direktori `vendor` mungkin kosong pada host Anda. Jalankan perintah ini untuk menginstal dependensi:
   ```bash
   docker compose exec app composer install
   ```

## 💻 Menjalankan Aplikasi

Untuk menjalankan aplikasi di mode development (termasuk Vite hot-reload):
```bash
make dev
```

- **Aplikasi Web (Laravel)**: `http://localhost:8088` (sesuai port di `docker-compose.yml`)
- **Vite Dev Server**: `http://localhost:5173`

Untuk mematikan seluruh container, jalankan:
```bash
make down
```

## 🛠️ Daftar Perintah (Makefile)

Proyek ini telah dilengkapi dengan beberapa perintah Makefile (shortcuts) yang bisa mempermudah pekerjaan sehari-hari. Anda bisa melihat seluruh daftar perintah dengan menjalankan:
```bash
make help
```

Beberapa perintah yang sering digunakan:
- `make up` : Menjalankan semua container di background (detached).
- `make down` : Mematikan semua container.
- `make shell` : Masuk ke dalam shell (terminal) container aplikasi (app).
- `make migrate` : Menjalankan migrasi database (`php artisan migrate`).
- `make cache-clear` : Menghapus semua cache aplikasi.
- `make logs` : Melihat log dari semua service.
- `make logs-app` : Melihat log khusus untuk service aplikasi utama.

## 🏗️ Struktur Service (Docker)

Konfigurasi `docker-compose.yml` mencakup service berikut:
- **app**: Web server utama berbasis FrankenPHP dan PHP 8.3.
- **worker**: Container untuk menjalankan queue worker (proses antrean di background).
- **postgres**: Database PostgreSQL versi 16.
- **redis**: Server Redis versi 7 untuk caching dan antrean.
- **vite**: Container Node.js untuk menjalankan development server Vite.
