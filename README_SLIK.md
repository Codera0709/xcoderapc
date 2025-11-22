# SLIK Data - Quick Start Guide

## Fitur yang Sudah Dibuat

✅ Menu SLIK Data di navigation bar  
✅ Upload foto KTP dengan preview  
✅ Auto-extract data KTP menggunakan OCR (placeholder)  
✅ Form verifikasi data manual  
✅ CRUD lengkap (Create, Read, Update, Delete)  
✅ Validation untuk semua input  
✅ Soft delete untuk data  
✅ Pagination untuk list data  

## Cara Menggunakan

### 1. Akses Aplikasi
```
http://localhost/slik
```

### 2. Tambah Data Baru
1. Klik tombol "Tambah Data Baru"
2. Upload foto KTP (JPG, PNG, max 5MB)
3. Klik "Proses KTP"
4. Verifikasi dan lengkapi data yang muncul di form
5. Klik "Simpan Data"

### 3. Edit Data
1. Dari list SLIK Data, klik tombol "Edit"
2. Update data yang diperlukan
3. Klik "Update Data"

### 4. Hapus Data
1. Dari list SLIK Data, klik tombol "Hapus"
2. Konfirmasi penghapusan

## File yang Dibuat

### Controllers
- `app/Http/Controllers/SlikDataController.php` - Main controller untuk SLIK Data

### Services
- `app/Services/KTPOCRService.php` - Service untuk OCR processing

### Views
- `resources/views/slik/index.blade.php` - List data SLIK
- `resources/views/slik/create.blade.php` - Form upload KTP & input data
- `resources/views/slik/edit.blade.php` - Form edit data

### Routes
- `routes/web.php` - Sudah ditambahkan routes untuk SLIK Data

### Documentation
- `resources/docs/SLIK_DATA_FEATURE.md` - Dokumentasi lengkap fitur
- `resources/docs/OCR_INTEGRATION.md` - Panduan integrasi OCR

### Configuration
- `config/services.php` - Konfigurasi OCR services
- `.env.example` - Template environment variables

## Status OCR

Saat ini OCR menggunakan **dummy data** untuk development/testing.

Untuk mengaktifkan OCR yang sebenarnya, pilih salah satu:

### Option 1: Google Cloud Vision API (Recommended)
```bash
composer require google/cloud-vision
```
Edit `app/Services/KTPOCRService.php`, uncomment method `googleVisionExtract()`

### Option 2: Tesseract OCR (Free, Self-hosted)
```bash
# Install Tesseract di server
composer require thiagoalessio/tesseract_ocr
```
Edit `app/Services/KTPOCRService.php`, uncomment method `tesseractExtract()`

### Option 3: OCR.space API (Free tier available)
Daftar di https://ocr.space/ocrapi  
Edit `app/Services/KTPOCRService.php`, uncomment method `ocrSpaceExtract()`

## Database

Menggunakan tabel `persons` yang sudah ada dengan field:
- nik (unique)
- nama_lengkap
- tempat_lahir, tanggal_lahir
- jenis_kelamin, golongan_darah
- alamat, rt, rw
- kelurahan, kecamatan
- kabupaten_kota, provinsi
- agama, status_perkawinan
- pekerjaan, kewarganegaraan
- berlaku_hingga

## Testing

1. Pastikan storage link sudah dibuat:
```bash
php artisan storage:link
```

2. Cek routes sudah terdaftar:
```bash
php artisan route:list --name=slik
```

3. Akses aplikasi dan test fitur upload KTP

## Troubleshooting

### Upload tidak berfungsi
- Pastikan folder `storage/app/public/ktp_uploads` ada dan writable
- Cek `php artisan storage:link` sudah dijalankan

### Form tidak muncul setelah upload
- Buka browser console untuk cek error JavaScript
- Pastikan CSRF token valid

### Data tidak tersimpan
- Cek validation error
- Pastikan NIK unique (belum ada di database)
- Cek semua required field sudah diisi

## Next Steps

1. **Implementasi OCR Real**  
   Pilih dan implementasikan salah satu provider OCR

2. **Improve Parsing**  
   Tingkatkan akurasi parsing text hasil OCR di `KTPOCRService::parseKTPText()`

3. **Image Preprocessing**  
   Tambahkan preprocessing gambar untuk meningkatkan akurasi OCR

4. **Generate PDF SPR**  
   Implementasi generate dokumen SPR dari data yang sudah tersimpan

5. **Export Data**  
   Tambahkan fitur export data ke Excel/PDF

## Support

Untuk pertanyaan atau issue, silakan buka issue di repository atau hubungi tim development.

---

**Status:** ✅ Ready for Testing  
**Version:** 1.0.0  
**Last Updated:** 21 November 2025
