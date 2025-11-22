# Project Structure Summary

## Active Folders & Their Functions:

### 1. presales (ACTIVE - Fungsional)
- Module utama untuk manajemen data penduduk
- Menyimpan dan mengelola data KTP
- Memiliki fitur pasangan (spouse) melalui hubungan database
- Tabel database: persons
- File view utama: index, create, edit, show

### 2. spouse (ACTIVE - Fungsional) 
- Module terpisah untuk manajemen data pasangan
- Dihubungkan dengan presales melalui foreign key spouse_id
- Digunakan untuk menyimpan data pasangan ketika status kawin
- File view: create, edit
- Controller: SpouseController

### 3. booking-units (ACTIVE - Fungsional)
- Module baru untuk booking unit (baru-baru ini ditambahkan)
- Menyediakan fitur pencarian data dari presales
- Auto-population form ketika data ditemukan
- File view: index, create, edit, show
- Controller: BookingUnitController

### 4. slik (ACTIVE - Fungsional)
- Module SLIK Data untuk manajemen data SLIK
- Upload KTP functionality
- Tabel database: slik_data
- File view: index, create, edit, show

## Inactive/Unused:
- presales.backup (telah dihapus - merupakan backup lama)

## Key Features:
- CRUD Operations untuk semua module utama
- Fitur pencarian lintas modul (booking units → presales)
- Form auto-population
- Relasi data antar entitas
- Antarmuka web dengan sidebar navigation
- Responsive design