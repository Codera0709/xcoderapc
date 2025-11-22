# XCODERA System

## Overview
Sistem manajemen data penduduk dan booking unit dengan fitur integrasi data lintas modul.

## Modules Structure

### 1. Presales (Data Penduduk)
Module utama untuk manajemen data penduduk/pendaftaran.
- **Location**: `/resources/views/presales`
- **Function**: Manajemen data KTP penduduk Indonesia
- **Database**: `persons` table
- **Features**:
  - CRUD data penduduk
  - Fitur pasangan (spouse) terintegrasi
  - Pencarian dan filter data

### 2. Spouse (Data Pasangan)
Module tambahan terintegrasi dengan presales.
- **Location**: `/resources/views/spouses`
- **Function**: Manajemen data pasangan untuk penduduk yang menikah
- **Integration**: Foreign key dari `persons.spouse_id`
- **Features**:
  - Form untuk data pasangan
  - Auto-link dengan data utama

### 3. Booking Units (Booking Unit Baru)
Module baru untuk booking unit properti.
- **Location**: `/resources/views/booking-units`
- **Function**: Manajemen booking unit dengan pencarian data dari presales
- **Features**:
  - Pencarian data dari presales (NIK/Nama)
  - Auto-population form ketika data ditemukan
  - Input manual jika data tidak ditemukan
  - CRUD operasi lengkap

### 4. SLIK Data
Module untuk manajemen data SLIK.
- **Location**: `/resources/views/slik`
- **Function**: Upload dan manajemen data SLIK
- **Features**:
  - Upload KTP
  - Pemrosesan dokumen

## Key Features
- **Cross-module search**: Booking units dapat mencari dan mengambil data dari presales
- **Auto-population**: Form yang otomatis terisi saat data ditemukan
- **Responsive UI**: Tampilan yang dapat digunakan di berbagai perangkat
- **Clean Architecture**: Struktur kode yang rapi dan terorganisir

## Navigation
- Sidebar dengan menu untuk semua modul aktif
- Navigasi yang intuitif dan mudah digunakan

## Development Notes
- Proyek ini menggunakan arsitektur MVC Laravel
- Database relations digunakan untuk menghubungkan data antar modul
- Template blade digunakan untuk tampilan
- JavaScript digunakan untuk fitur dinamis (AJAX search)

## Maintenance
Proyek ini telah dirapikan:
- Backup lama (presales.backup) telah dihapus
- Struktur tampilan telah dioptimalkan
- Kode bersih dan terorganisir