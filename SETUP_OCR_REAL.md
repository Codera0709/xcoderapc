# Setup OCR Real - Panduan Lengkap

## 🎯 Tujuan
Mengaktifkan OCR real agar data yang muncul sesuai dengan KTP yang diupload.

---

## ✅ Opsi 1: OCR.space API (RECOMMENDED - Paling Mudah)

### Kelebihan:
- ✅ Gratis 25,000 requests/month
- ✅ Tidak perlu install apapun
- ✅ Mudah setup (5 menit)
- ✅ Support bahasa Indonesia
- ✅ Akurasi cukup baik

### Step-by-Step Setup:

#### 1. Daftar dan Dapatkan API Key

1. Buka: https://ocr.space/ocrapi
2. Klik "Register" atau "Get Free API Key"
3. Isi form registrasi:
   - Email
   - Password
   - Nama
4. Verifikasi email
5. Login dan copy API Key Anda

#### 2. Tambahkan API Key ke .env

Buka file `.env` dan tambahkan:

```env
OCR_SPACE_API_KEY=K12345678901234567890123456789
```

Ganti dengan API key Anda yang sebenarnya.

#### 3. Verifikasi Config

File `config/services.php` sudah dikonfigurasi:

```php
'ocr_space' => [
    'api_key' => env('OCR_SPACE_API_KEY'),
],
```

#### 4. Aktifkan OCR.space di Service

File `app/Services/KTPOCRService.php` sudah diupdate untuk menggunakan OCR.space:

```php
public function extractData($file)
{
    return $this->ocrSpaceExtract($file);
}
```

#### 5. Clear Cache

```bash
php artisan config:clear
php artisan cache:clear
```

#### 6. Test!

1. Akses: `http://localhost/slik/create`
2. Upload foto KTP yang jelas
3. Klik "Proses KTP"
4. Data akan terisi sesuai KTP

### Troubleshooting OCR.space:

#### Error: "Invalid API Key"
**Solusi:**
- Cek API key di .env sudah benar
- Pastikan tidak ada spasi di awal/akhir
- Run `php artisan config:clear`

#### Error: "Rate limit exceeded"
**Solusi:**
- Free tier: 25,000 requests/month
- Tunggu bulan depan atau upgrade ke paid plan

#### Data tidak akurat
**Solusi:**
- Pastikan foto KTP jelas dan tidak blur
- Pencahayaan cukup
- KTP dalam posisi horizontal
- Resolusi minimal 1000x600 pixels

---

## 🔧 Opsi 2: Google Cloud Vision API (Paling Akurat)

### Kelebihan:
- ✅ Akurasi sangat tinggi
- ✅ Support banyak bahasa
- ✅ Reliable dan cepat
- ⚠️ Perlu setup Google Cloud
- ⚠️ Paid (tapi ada free tier)

### Step-by-Step Setup:

#### 1. Setup Google Cloud Project

1. Buka: https://console.cloud.google.com
2. Create new project
3. Enable "Cloud Vision API"
4. Create Service Account:
   - IAM & Admin > Service Accounts
   - Create Service Account
   - Grant role: "Cloud Vision API User"
5. Create Key (JSON)
6. Download JSON key file

#### 2. Simpan Credentials

```bash
# Copy JSON key ke storage
copy path\to\your-key.json storage\app\google-vision-key.json
```

#### 3. Update .env

```env
GOOGLE_APPLICATION_CREDENTIALS=storage/app/google-vision-key.json
```

#### 4. Install Package

```bash
composer require google/cloud-vision
```

#### 5. Aktifkan di Service

Edit `app/Services/KTPOCRService.php`:

```php
public function extractData($file)
{
    return $this->googleVisionExtract($file);
}
```

Uncomment method `googleVisionExtract()`.

#### 6. Test

Upload KTP dan test.

---

## 🆓 Opsi 3: Tesseract OCR (Free, Self-hosted)

### Kelebihan:
- ✅ Gratis selamanya
- ✅ Privacy terjaga (local)
- ✅ Tidak perlu internet
- ⚠️ Perlu install di server
- ⚠️ Akurasi lebih rendah

### Step-by-Step Setup:

#### 1. Install Tesseract

**Windows:**
1. Download: https://github.com/UB-Mannheim/tesseract/wiki
2. Install Tesseract-OCR
3. Tambahkan ke PATH

**Linux:**
```bash
sudo apt-get update
sudo apt-get install tesseract-ocr
sudo apt-get install tesseract-ocr-ind  # Indonesian language
```

#### 2. Install PHP Package

```bash
composer require thiagoalessio/tesseract_ocr
```

#### 3. Aktifkan di Service

Edit `app/Services/KTPOCRService.php`:

```php
public function extractData($file)
{
    return $this->tesseractExtract($file);
}
```

Uncomment method `tesseractExtract()`.

#### 4. Test

Upload KTP dan test.

---

## 📊 Perbandingan OCR Providers

| Feature | OCR.space | Google Vision | Tesseract |
|---------|-----------|---------------|-----------|
| **Akurasi** | ⭐⭐⭐ | ⭐⭐⭐⭐⭐ | ⭐⭐ |
| **Kecepatan** | ⭐⭐⭐⭐ | ⭐⭐⭐⭐⭐ | ⭐⭐⭐ |
| **Setup** | ⭐⭐⭐⭐⭐ | ⭐⭐ | ⭐⭐⭐ |
| **Biaya** | Free tier | Paid (free tier) | Free |
| **Privacy** | ⚠️ Cloud | ⚠️ Cloud | ✅ Local |
| **Maintenance** | ✅ Easy | ✅ Easy | ⚠️ Medium |

**Rekomendasi:**
- **Development/Testing:** OCR.space (paling mudah)
- **Production (High Volume):** Google Vision (paling akurat)
- **Privacy Critical:** Tesseract (local processing)

---

## 🎨 Tips untuk Hasil OCR Terbaik

### 1. Kualitas Gambar
- ✅ Resolusi minimal: 1000x600 pixels
- ✅ Format: JPG atau PNG
- ✅ Ukuran file: 500KB - 2MB optimal
- ❌ Hindari: blur, gelap, terlalu terang

### 2. Posisi KTP
- ✅ Horizontal (landscape)
- ✅ Seluruh KTP terlihat
- ✅ Tidak terpotong
- ❌ Hindari: miring, terbalik

### 3. Pencahayaan
- ✅ Cahaya merata
- ✅ Tidak ada bayangan
- ✅ Tidak ada refleksi/kilau
- ❌ Hindari: flash langsung

### 4. Background
- ✅ Background polos (putih/gelap)
- ✅ Kontras dengan KTP
- ❌ Hindari: background ramai

---

## 🔍 Debugging OCR

### Cek Laravel Log

```bash
# Windows
type storage\logs\laravel.log | findstr /i "ocr"

# Atau buka file
notepad storage\logs\laravel.log
```

Log akan menampilkan:
- Request ke OCR API
- Response dari OCR
- Text yang di-extract
- Data yang di-parse

### Test Manual OCR.space

Buka: https://ocr.space/

1. Upload foto KTP Anda
2. Pilih language: Indonesian
3. Klik "Start OCR"
4. Lihat hasil text
5. Bandingkan dengan hasil di aplikasi

### Console Browser

Buka F12 > Console, akan muncul:
```
Response: {success: true, data: {...}}
Parsed KTP data: {nik: "...", nama: "..."}
```

---

## 📝 Checklist Setup

### OCR.space Setup:
- [ ] Daftar di ocr.space
- [ ] Dapatkan API key
- [ ] Tambahkan ke .env
- [ ] Clear cache
- [ ] Test upload KTP
- [ ] Verifikasi data terisi

### Verifikasi:
- [ ] NIK terisi (16 digit)
- [ ] Nama terisi
- [ ] Tempat/Tanggal lahir terisi
- [ ] Alamat terisi
- [ ] RT/RW terisi
- [ ] Kelurahan/Kecamatan terisi
- [ ] Agama terisi
- [ ] Pekerjaan terisi

---

## 🆘 Troubleshooting Umum

### Problem: Data tidak terisi sama sekali

**Kemungkinan:**
1. API key tidak valid
2. OCR service error
3. Foto KTP tidak terbaca

**Solusi:**
1. Cek Laravel log
2. Cek browser console
3. Test manual di ocr.space
4. Coba foto KTP lain yang lebih jelas

### Problem: Beberapa field tidak terisi

**Kemungkinan:**
1. OCR tidak bisa baca field tersebut
2. Format KTP berbeda
3. Parsing regex tidak match

**Solusi:**
1. Normal behavior - user harus isi manual
2. Improve parsing di `parseKTPText()`
3. Gunakan OCR provider yang lebih baik

### Problem: Data salah/typo

**Kemungkinan:**
1. OCR misread text
2. Foto kurang jelas

**Solusi:**
1. User harus verifikasi dan koreksi manual
2. Upload foto yang lebih jelas
3. Gunakan OCR provider yang lebih akurat

---

## 📞 Support

Jika masih ada masalah:

1. Cek log: `storage/logs/laravel.log`
2. Cek console browser (F12)
3. Test manual di ocr.space
4. Screenshot error dan kirim ke tim development

---

**Status:** ✅ Ready to Implement  
**Recommended:** OCR.space API  
**Estimated Time:** 5-10 minutes  
**Last Updated:** 21 November 2025
