# Sistem Presensi Sederhana

Website presensi sederhana yang dibuat menggunakan Laravel 12. Aplikasi ini memungkinkan pengguna untuk mencatat kehadiran dengan berbagai status seperti Hadir, Izin, Sakit, dan Alpha.

## Fitur Utama

✅ **CRUD Presensi Lengkap**
- Tambah data presensi baru
- Lihat daftar semua presensi
- Edit data presensi
- Hapus data presensi
- Detail presensi

✅ **Status Kehadiran**
- Hadir
- Izin
- Sakit  
- Alpha

✅ **Informasi Lengkap**
- Nama lengkap
- NIM (opsional)
- Tanggal dan waktu
- Keterangan tambahan

✅ **UI Modern & Responsif**
- Desain menggunakan Bootstrap 5
- Responsive untuk semua device
- Ikon Font Awesome
- Gradient background yang menarik

✅ **Dashboard & Statistik**
- Ringkasan jumlah kehadiran berdasarkan status
- Tabel data dengan pagination
- Search dan filter (akan ditambahkan)

## Teknologi yang Digunakan

- **Backend**: Laravel 12
- **Frontend**: Bootstrap 5, Font Awesome
- **Database**: SQLite (default)
- **PHP**: 8.3+

## Struktur Database

Tabel `presensis`:
- `id` - Primary key
- `nama` - Nama lengkap (required)
- `nim` - Nomor Induk Mahasiswa (optional)
- `status` - Status kehadiran (Hadir/Izin/Sakit/Alpha)
- `keterangan` - Keterangan tambahan (optional)
- `tanggal` - Tanggal presensi
- `waktu` - Waktu presensi
- `created_at` - Waktu dibuat
- `updated_at` - Waktu diperbarui

## Instalasi

1. **Clone atau download project**
2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Setup environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Jalankan migration**
   ```bash
   php artisan migrate
   ```

5. **Jalankan seeder (opsional - untuk data contoh)**
   ```bash
   php artisan db:seed --class=PresensiSeeder
   ```

6. **Jalankan server**
   ```bash
   php artisan serve
   ```

7. **Buka browser ke** `http://127.0.0.1:8000`

## Cara Penggunaan

### 1. **Menambah Presensi Baru**
- Klik tombol "Tambah Presensi" di halaman utama
- Isi form dengan lengkap
- Pilih status kehadiran
- Tambahkan keterangan jika diperlukan
- Klik "Simpan Data"

### 2. **Melihat Daftar Presensi**
- Halaman utama menampilkan semua data presensi
- Data ditampilkan dalam bentuk tabel dengan pagination
- Terdapat statistik ringkasan di bagian bawah

### 3. **Mengedit Presensi**
- Klik tombol edit (ikon pensil) pada data yang ingin diubah
- Update informasi yang diperlukan
- Klik "Update Data"

### 4. **Melihat Detail Presensi**
- Klik tombol view (ikon mata) untuk melihat detail lengkap
- Informasi termasuk waktu dibuat dan diperbarui

### 5. **Menghapus Presensi**
- Klik tombol hapus (ikon sampah)
- Konfirmasi penghapusan
- Data akan dihapus permanen

## Screenshot

### Dashboard Utama
- Tabel daftar presensi dengan status berwarna
- Tombol aksi (lihat, edit, hapus)
- Statistik ringkasan kehadiran

### Form Tambah/Edit
- Form yang user-friendly
- Validasi input
- Auto-fill waktu saat ini
- Dropdown status dengan ikon

### Detail Presensi
- Tampilan detail lengkap
- Informasi metadata
- Aksi edit dan hapus

## Pengembangan Selanjutnya

🔄 **Fitur yang bisa ditambahkan:**
- Export data ke Excel/PDF
- Filter berdasarkan tanggal
- Search berdasarkan nama
- Import data dari Excel
- Sistem autentikasi
- Multi-user support
- Laporan statistik
- Notifikasi email
- API endpoints
- Backup data otomatis

## Kontribusi

Silakan fork project ini dan kirim pull request untuk improvement.

## Lisensi

Open source - MIT License.

---

**Dibuat dengan ❤️ menggunakan Laravel**

*Website presensi sederhana yang mudah digunakan dan mudah dikustomisasi.*
