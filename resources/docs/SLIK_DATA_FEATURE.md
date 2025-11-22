# Fitur SLIK Data - Upload KTP & Auto Extract

## Deskripsi
Fitur ini memungkinkan user untuk:
1. Upload foto KTP
2. Sistem otomatis extract data dari KTP menggunakan OCR
3. Data hasil extract ditampilkan di form untuk verifikasi manual
4. User dapat mengedit/melengkapi data sebelum disimpan
5. Data tersimpan di database untuk keperluan SLIK

## Cara Penggunaan

### 1. Akses Menu SLIK Data
- Login ke aplikasi
- Klik menu "SLIK Data" di navigation bar
- Klik tombol "Tambah Data Baru"

### 2. Upload KTP
- Klik area upload atau drag & drop foto KTP
- Format yang didukung: JPG, JPEG, PNG (max 5MB)
- Preview gambar akan muncul setelah upload
- Klik tombol "Proses KTP"

### 3. Verifikasi Data
- Sistem akan memproses gambar dan extract data KTP
- Data hasil extract otomatis mengisi form
- Periksa dan koreksi data jika ada yang salah
- Lengkapi field yang masih kosong

### 4. Simpan Data
- Setelah semua data benar, klik "Simpan Data"
- Data akan tersimpan di database
- Redirect ke halaman list SLIK Data

## Field yang Di-extract

### Data Utama:
- NIK (16 digit)
- Nama Lengkap
- Tempat Lahir
- Tanggal Lahir
- Jenis Kelamin
- Golongan Darah

### Data Alamat:
- Alamat
- RT/RW
- Kelurahan/Desa
- Kecamatan
- Kabupaten/Kota
- Provinsi

### Data Lainnya:
- Agama
- Status Perkawinan
- Pekerjaan
- Kewarganegaraan
- Berlaku Hingga

## Fitur Tambahan

### List Data SLIK
- Menampilkan semua data SLIK yang sudah tersimpan
- Pagination untuk data yang banyak
- Fitur Edit dan Hapus data

### Edit Data
- Klik tombol "Edit" pada data yang ingin diubah
- Update data yang diperlukan
- Simpan perubahan

### Hapus Data
- Klik tombol "Hapus" pada data yang ingin dihapus
- Konfirmasi penghapusan
- Data akan di-soft delete (masih bisa di-restore)

## Teknologi yang Digunakan

### Backend:
- Laravel 11
- Model: Person (menggunakan tabel persons)
- Controller: SlikDataController
- Validation untuk semua input

### Frontend:
- Blade Templates
- Tailwind CSS untuk styling
- Alpine.js untuk interaktivity
- Vanilla JavaScript untuk upload & OCR processing

### OCR:
- Placeholder function untuk integrasi OCR
- Bisa diintegrasikan dengan:
  - Google Cloud Vision API
  - Tesseract OCR
  - OCR.space API
- Lihat file `OCR_INTEGRATION.md` untuk detail

## Routes

```php
GET  /slik              - List semua data SLIK
GET  /slik/create       - Form tambah data baru (upload KTP)
POST /slik              - Simpan data baru
GET  /slik/{id}/edit    - Form edit data
PUT  /slik/{id}         - Update data
DELETE /slik/{id}       - Hapus data
POST /slik/upload-ktp   - API endpoint untuk upload & process KTP
```

## Database
Menggunakan tabel `persons` dengan field:
- id
- nik (unique)
- nama_lengkap
- tempat_lahir
- tanggal_lahir
- jenis_kelamin
- golongan_darah
- alamat
- rt, rw
- kelurahan, kecamatan
- kabupaten_kota, provinsi
- agama
- status_perkawinan
- pekerjaan
- kewarganegaraan
- berlaku_hingga
- spouse_id (nullable)
- timestamps
- deleted_at (soft delete)

## Security
- Middleware: auth, verified
- CSRF Protection
- File validation (type, size)
- Input validation untuk semua field
- Unique constraint untuk NIK

## Tips untuk Hasil OCR Terbaik
1. Pastikan foto KTP jelas dan tidak blur
2. Pencahayaan yang cukup
3. KTP dalam posisi horizontal
4. Tidak ada bayangan atau refleksi
5. Resolusi minimal 1000x600 pixels

## Troubleshooting

### Upload gagal
- Cek ukuran file (max 5MB)
- Cek format file (hanya JPG, JPEG, PNG)
- Pastikan storage/app/public/ktp_uploads ada dan writable

### OCR tidak akurat
- Cek kualitas gambar
- Implementasikan OCR provider yang lebih baik
- Tambahkan pre-processing gambar (contrast, brightness)

### Data tidak tersimpan
- Cek validation error
- Pastikan NIK unique (belum ada di database)
- Cek semua required field sudah diisi
