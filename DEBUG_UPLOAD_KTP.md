# Debug Guide - Upload KTP Issue

## Issue: Button "Proses KTP" tidak bisa diklik setelah upload

## Solusi yang Sudah Diterapkan

### 1. JavaScript dipindahkan ke DOMContentLoaded
- Memastikan semua element sudah loaded sebelum attach event listener
- Menghindari error "element not found"

### 2. Validasi File ditambahkan
- Validasi file type (JPG, JPEG, PNG)
- Validasi file size (max 5MB)
- Alert jika file tidak valid

### 3. Button state management diperbaiki
- Remove class `opacity-50` dan `cursor-not-allowed` saat enabled
- Add class `hover:bg-blue-700` saat enabled
- Disable button saat processing
- Change text ke "Memproses..." saat processing

### 4. Error handling ditingkatkan
- Try-catch untuk handle network error
- Console.error untuk debugging
- Alert message yang lebih jelas

## Cara Testing

### 1. Buka Browser Console
```
F12 atau Right Click > Inspect > Console
```

### 2. Akses halaman
```
http://localhost/slik/create
```

### 3. Upload file KTP
- Klik area upload atau drag & drop
- Pilih file gambar KTP

### 4. Cek Console
Jika ada error, akan muncul di console. Catat error message-nya.

### 5. Cek Button State
Setelah upload, button "Proses KTP" seharusnya:
- Tidak ada attribute `disabled`
- Background color berubah dari gray ke blue
- Cursor berubah dari not-allowed ke pointer
- Hover effect berfungsi

### 6. Klik Button
- Klik "Proses KTP"
- Loading indicator muncul
- Button text berubah ke "Memproses..."
- Setelah selesai, form muncul di bawah

## Troubleshooting

### Button masih disabled setelah upload

**Kemungkinan penyebab:**
1. JavaScript belum load
2. Event listener belum attach
3. File validation gagal

**Solusi:**
1. Refresh halaman (Ctrl+F5)
2. Cek console untuk error
3. Pastikan file yang diupload valid (JPG/PNG, < 5MB)

### Preview gambar tidak muncul

**Kemungkinan penyebab:**
1. FileReader tidak support di browser
2. File corrupt

**Solusi:**
1. Gunakan browser modern (Chrome, Firefox, Edge)
2. Coba file gambar lain

### Button bisa diklik tapi tidak ada response

**Kemungkinan penyebab:**
1. Route tidak ditemukan
2. CSRF token invalid
3. Server error

**Solusi:**
1. Cek console untuk network error
2. Cek Network tab di DevTools
3. Cek Laravel log: `storage/logs/laravel.log`

### Form tidak muncul setelah processing

**Kemungkinan penyebab:**
1. Response dari server tidak sesuai format
2. JavaScript error saat populate form

**Solusi:**
1. Cek response di Network tab
2. Cek console untuk JavaScript error
3. Pastikan response format: `{success: true, data: {...}}`

## Manual Testing Steps

### Test 1: Upload Valid File
```
1. Pilih file JPG < 5MB
2. Preview muncul ✓
3. Button enabled ✓
4. Klik button
5. Loading muncul ✓
6. Form muncul ✓
```

### Test 2: Upload Invalid File Type
```
1. Pilih file PDF/DOC
2. Alert "Format file tidak valid" ✓
3. Preview tidak muncul ✓
4. Button tetap disabled ✓
```

### Test 3: Upload File Terlalu Besar
```
1. Pilih file > 5MB
2. Alert "Ukuran file terlalu besar" ✓
3. Preview tidak muncul ✓
4. Button tetap disabled ✓
```

### Test 4: Klik Button Tanpa Upload
```
1. Langsung klik button (seharusnya disabled)
2. Tidak ada response ✓
```

## Browser Console Commands untuk Debug

### Cek apakah element ada
```javascript
console.log(document.getElementById('ktp-upload'));
console.log(document.getElementById('process-btn'));
console.log(document.getElementById('preview-image'));
```

### Cek button state
```javascript
const btn = document.getElementById('process-btn');
console.log('Disabled:', btn.disabled);
console.log('Classes:', btn.className);
```

### Manual enable button (untuk testing)
```javascript
const btn = document.getElementById('process-btn');
btn.disabled = false;
btn.classList.remove('opacity-50', 'cursor-not-allowed');
```

### Test upload manually
```javascript
const file = document.getElementById('ktp-upload').files[0];
console.log('File:', file);
console.log('Type:', file?.type);
console.log('Size:', file?.size);
```

## Expected Behavior

### Initial State
- Upload area visible
- Preview hidden
- Button disabled (gray, opacity-50)
- Form hidden

### After Upload
- Upload area hidden
- Preview visible with image
- Button enabled (blue, hover effect)
- Form still hidden

### After Click Process
- Button disabled with text "Memproses..."
- Loading indicator visible
- After success: Form visible with data
- After error: Alert message, button enabled again

## Laravel Log Check

Jika masih ada masalah, cek Laravel log:

```bash
# Windows
type storage\logs\laravel.log | findstr /i "error"

# Atau buka file langsung
notepad storage\logs\laravel.log
```

Cari error terkait:
- SlikDataController
- uploadKtp
- KTPOCRService

## Network Request Check

Di Browser DevTools > Network tab:

1. Filter: XHR
2. Upload file dan klik process
3. Cari request ke `/slik/upload-ktp`
4. Cek:
   - Status: 200 OK
   - Response: `{success: true, data: {...}}`
   - Headers: Content-Type: application/json

## Quick Fix Commands

### Clear cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Recreate storage link
```bash
php artisan storage:link
```

### Check permissions
```bash
# Windows (PowerShell as Admin)
icacls storage /grant Users:F /T
```

## Contact Support

Jika masih ada masalah setelah semua troubleshooting:

1. Screenshot error di console
2. Screenshot Network tab
3. Copy Laravel log error
4. Kirim ke tim development

---

**Last Updated:** 21 November 2025  
**Version:** 1.0.1
