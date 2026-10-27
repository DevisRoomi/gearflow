# GearFlow ⚡

> **Buku Log & Sirkulasi Peminjaman Inventaris Fisik Studio Multimedia & Lab Produksi.**  
> Dibangun dengan arsitektur **Next.js 16 (App Router)**, **TypeScript Strict**, dan estetika **Modern Soft Brutalism**. Dirancang bebas dari pola AI slop generik (tanpa gradient text, tanpa glow blob, tanpa bento grid kosong).

---

## 🛠️ Fitur Utama

- **Katalog Unit & Loker Fisik:** Pelacakan nomor seri unik (`CAM-FX3-01`, `LNS-2470-01`), status loker drybox, kondisi fisik, dan catatan perlengkapan bawaan.
- **Formulir Surat Jalan Terpadu:** Pengajuan multi-alat per kru, validasi tanggal pengembalian, dan penentuan tujuan produksi.
- **Verifikasi & Serah Terima Staf:** Aksi cepat serah terima fisik (status terkunci ke `ACTIVE HANDOVER`), konfirmasi cek fisik saat kembali (status pulih ke `READY LOKER`), atau penolakan surat jalan.
- **Anti AI-Slop & Human Touch:**
  - Tipografi editorial ekspresif: `Syne` (display), `Plus Jakarta Sans` (body), `JetBrains Mono` (nomor seri rak/surat).
  - Desain fisik: Kartu kertas hangat (`#F5EFEB`), border tegas 2.5px, bayangan solid tanpa blur, dan badge stempel loker.
  - Komponen modular atomik: `Header`, `StatsOverview`, `CatalogSection`, `LoanLogSection`, `LoanModal`, `Footer`.

---

## 🚀 Menjalankan Proyek Lokal

Gunakan **Bun** (disarankan untuk efisiensi RAM) atau Node.js / npm:

```bash
# Install dependencies
bun install

# Menjalankan dev server (port 3000)
bun dev

# Menjalankan production build
bun run build
bun start
```

Buka `http://localhost:3000` di browser.

