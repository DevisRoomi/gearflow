# ⚡ GearFlow

> **Modern Soft Brutalism** Lab & Multimedia Equipment Lending System built with Laravel.

---

## 🎯 Ringkasan Proyek

- **Nama Web:** GearFlow
- **Tema Desain:** Modern Brutalism (Soft Brutalism)
- **Tujuan:** Digitalisasi dan pelacakan peminjaman alat multimedia & perangkat laboratorium secara mandiri, akurat, dan transparan.
- **Masalah:**
  - Catatan peminjaman manual di buku/kertas rawan hilang dan tidak terbaca.
  - Kondisi fisik alat sebelum dan sesudah serah terima tidak terdokumentasi rapi.
  - Tidak ada visibilitas ketersediaan alat secara real-time.
- **Solusi:**
  - Katalog digital interaktif dengan status unit live (*Ready*, *Borrowed*, *Maintenance*).
  - Alur approval peminjaman multi-item dengan pelacakan tanggal kembali.
  - Logging kondisi fisik barang sebelum dan sesudah serah terima.

---

## 🚀 Fitur Utama

1. **Dashboard Metrik:** Ringkasan total unit alat, unit siap pakai, peminjaman aktif, dan pending request.
2. **Katalog & Filter Kategori:** Filter cepat berbasis kategori (*Cameras & Lenses*, *Audio*, *Lighting*, *Computing & VR*).
3. **Pencarian Cepat:** Cari alat berdasarkan kode unit (misal `CAM-01`), brand, atau nama alat.
4. **Peminjaman Mandiri:** Form pengajuan multi-item dengan rentang tanggal dan tujuan pinjam.
5. **Manajemen Approval & Serah Terima:** Staf dapat menyetujui, menolak, dan menandai alat selesai dikembalikan dalam satu klik.
6. **Sinkronisasi Stok Otomatis:** Perubahan status transaksi otomatis memperbarui status ketersediaan barang di katalog.
7. **UI Soft Brutalism:** Border tegas, bayangan keras (*hard offset shadow*), palet pastel kontras (*pastel cream, yellow, blue, green*), dan tipografi *Space Grotesk*.

---

## 👥 Role & Hak Akses

- **Admin / Staf Lab:** Full control atas seluruh transaksi, approval/rejection, konfirmasi serah terima, serta monitoring kondisi unit.
- **Borrower (Peminjam):** Melihat ketersediaan katalog alat secara real-time dan mengajukan form peminjaman.

---

## 🗄️ Database & Arsitektur

- **users:** Data staf lab dan peminjam (role, phone, department).
- **categories:** Kategori alat beserta label warna badge brutalism.
- **gears:** Master data alat (kode unik, brand, kondisi fisik, status ketersediaan, lokasi rak).
- **loans:** Header transaksi peminjaman (kode pinjam unik, user_id, tanggal pinjam/kembali, status, catatan admin).
- **loan_items:** Detail relasi barang per peminjaman beserta kondisi sebelum dan sesudah.

---

## 🛠️ Cara Menjalankan Lokal

1. **Clone repository:**
   ```bash
   git clone https://github.com/DevisRoomi/gearflow.git
   cd gearflow
   ```

2. **Setup environment & dependency:**
   ```bash
   cp .env.example .env
   # sesuaikan DB_PASSWORD (contoh FlyEnv: root / root)
   composer install
   php artisan key:generate
   ```

3. **Migrasi & Seed Data:**
   ```bash
   php artisan migrate --seed
   ```

4. **Jalankan Aplikasi:**
   - Melalui **Laravel Herd**: Langsung akses `http://gearflow.test`
   - Melalui Artisan Serve: `php artisan serve` lalu buka `http://localhost:8000`
