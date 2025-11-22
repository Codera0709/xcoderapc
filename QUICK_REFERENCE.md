# Quick Reference - SLIK Data

## 🚀 Cara Menggunakan

### 1. Akses Menu
```
Login → Menu "SLIK Data" → Tambah Data Baru
```

### 2. Upload & Process
1. Upload foto KTP (JPG/PNG, max 5MB)
2. Preview muncul
3. Klik "Proses KTP"
4. Data otomatis terisi (background hijau)
5. Verifikasi & lengkapi data
6. Klik "Simpan Data"

## 📁 File Locations

### Backend
```
app/Http/Controllers/SlikDataController.php  - Main controller
app/Services/KTPOCRService.php               - OCR service
routes/web.php                                - Routes
```

### Frontend
```
resources/views/slik/index.blade.php         - List data
resources/views/slik/create.blade.php        - Upload & form
resources/views/slik/edit.blade.php          - Edit form
resources/views/layouts/navigation.blade.php - Menu
```

### Documentation
```
README_SLIK.md              - Quick start guide
OCR_INTEGRATION.md          - OCR setup guide
IMPLEMENTATION_SUMMARY.md   - Implementation details
TESTING_CHECKLIST.md        - Testing guide
DEBUG_UPLOAD_KTP.md         - Debug guide
CHANGELOG_SLIK.md           - Version history
```

## 🔧 Current Status

### ✅ Working
- Upload KTP dengan preview
- Button "Proses KTP" berfungsi
- Data populate ke form (dummy data)
- Visual feedback (green background)
- Form validation
- CRUD operations
- Soft delete

### ⚠️ Pending
- OCR real implementation (masih dummy data)
- Image preprocessing
- Advanced parsing

## 🎯 Dummy Data (Testing)

Saat ini OCR return contoh data:
```
NIK: 3201234567890123
Nama: JOHN DOE
Tempat Lahir: JAKARTA
Tanggal Lahir: 1990-01-15
... dst
```

**Note:** Ini untuk testing. Untuk production, implementasikan OCR real.

## 🔍 Debugging

### Browser Console (F12)
```javascript
// Cek response
Response: {success: true, data: {...}}

// Cek field populated
Field nik: <input> Value: 3201234567890123
Populated 18 fields
```

### Laravel Log
```bash
# Windows
type storage\logs\laravel.log
```

## 🛠️ Common Issues

### Issue: Button tidak bisa diklik
**Solution:** 
- Refresh (Ctrl+F5)
- Cek file valid (JPG/PNG, < 5MB)
- Cek console untuk error

### Issue: Data tidak muncul di form
**Solution:**
- Cek console log
- Pastikan response success
- Cek ID field match dengan data key

### Issue: Form tidak muncul
**Solution:**
- Cek JavaScript error di console
- Pastikan `formSection` element ada
- Cek response format

## 📝 Routes

```php
GET  /slik              - List data
GET  /slik/create       - Upload form
POST /slik              - Save data
GET  /slik/{id}/edit    - Edit form
PUT  /slik/{id}         - Update data
DELETE /slik/{id}       - Delete data
POST /slik/upload-ktp   - Process KTP (AJAX)
```

## 🔐 Security

- ✅ Auth middleware
- ✅ CSRF protection
- ✅ File validation
- ✅ Input validation
- ✅ Unique NIK constraint

## 📊 Database

Table: `persons`

Required fields:
- nik (16 digit, unique)
- nama_lengkap
- tempat_lahir
- tanggal_lahir
- jenis_kelamin
- alamat, rt, rw
- kelurahan, kecamatan
- kabupaten_kota, provinsi
- agama, status_perkawinan
- pekerjaan, kewarganegaraan

## 🎨 Visual Features

### Upload Area
- Drag & drop support
- File preview
- Validation feedback

### Form
- Auto-populate from OCR
- Green background for filled fields
- Validation errors
- Required field markers (*)

### List
- Pagination
- Edit/Delete buttons
- Success messages

## 🚀 Next Steps

### Untuk Testing
1. Test upload berbagai format file
2. Test dengan file besar
3. Test form validation
4. Test CRUD operations

### Untuk Production
1. Pilih OCR provider:
   - Google Cloud Vision (recommended)
   - Tesseract OCR (free)
   - OCR.space (free tier)
2. Setup credentials
3. Update `KTPOCRService.php`
4. Test dengan KTP real
5. Fine-tune parsing

## 📞 Quick Commands

### Clear Cache
```bash
php artisan cache:clear
php artisan view:clear
php artisan config:clear
```

### Check Routes
```bash
php artisan route:list --name=slik
```

### Storage Link
```bash
php artisan storage:link
```

### View Logs
```bash
# Latest errors
type storage\logs\laravel.log | findstr /i "error"
```

## 💡 Tips

1. **Testing**: Gunakan dummy data dulu, baru implement OCR real
2. **Debugging**: Selalu cek browser console dan Laravel log
3. **Validation**: User harus tetap verifikasi data OCR
4. **Image Quality**: Kualitas gambar sangat mempengaruhi akurasi OCR
5. **Backup**: Simpan foto KTP untuk reference

## 📚 Documentation Links

- [Quick Start](README_SLIK.md)
- [OCR Integration](OCR_INTEGRATION.md)
- [Testing Guide](TESTING_CHECKLIST.md)
- [Debug Guide](DEBUG_UPLOAD_KTP.md)
- [Changelog](CHANGELOG_SLIK.md)

---

**Version:** 1.0.2  
**Status:** ✅ Ready for Testing  
**Last Updated:** 21 November 2025
