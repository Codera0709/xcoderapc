# Quick Start - Aktifkan OCR Real (5 Menit)

## 🚀 Langkah Cepat

### 1. Daftar OCR.space (2 menit)
```
1. Buka: https://ocr.space/ocrapi
2. Klik "Register" 
3. Isi email & password
4. Verifikasi email
5. Login dan copy API Key
```

### 2. Tambahkan API Key (1 menit)

Buka file `.env` dan tambahkan di baris paling bawah:

```env
OCR_SPACE_API_KEY=K12345678901234567890123456789
```

**Ganti dengan API key Anda!**

### 3. Clear Cache (30 detik)

Buka terminal/command prompt di folder project:

```bash
php artisan config:clear
```

### 4. Test! (1 menit)

```
1. Buka: http://localhost/slik/create
2. Upload foto KTP yang jelas
3. Klik "Proses KTP"
4. ✅ Data akan terisi sesuai KTP!
```

---

## ✅ Selesai!

Sekarang data yang muncul akan sesuai dengan KTP yang diupload.

**Tips:**
- Gunakan foto KTP yang jelas dan tidak blur
- Pastikan pencahayaan cukup
- KTP dalam posisi horizontal

---

## 🔍 Cek Apakah Berhasil

Setelah upload dan klik "Proses KTP":

✅ **Berhasil jika:**
- NIK terisi 16 digit
- Nama terisi
- Alamat terisi
- Field lain terisi (minimal 10-15 field)
- Background field hijau

❌ **Gagal jika:**
- Semua field kosong
- Muncul error "Invalid API Key"
- Data masih dummy (JOHN DOE)

---

## 🆘 Troubleshooting

### Data masih dummy (JOHN DOE)?

**Cek:**
1. API key sudah ditambahkan di `.env`?
2. Sudah run `php artisan config:clear`?
3. API key valid? (coba login ke ocr.space)

### Error "Invalid API Key"?

**Solusi:**
1. Cek API key tidak ada spasi
2. Copy ulang dari ocr.space
3. Pastikan format: `OCR_SPACE_API_KEY=K...`

### Data tidak akurat?

**Normal!** OCR tidak 100% akurat.

**Solusi:**
- User harus verifikasi manual
- Upload foto yang lebih jelas
- Gunakan Google Vision API (lebih akurat tapi bayar)

---

## 📚 Dokumentasi Lengkap

Lihat: `SETUP_OCR_REAL.md` untuk:
- Setup Google Cloud Vision
- Setup Tesseract OCR
- Tips foto KTP terbaik
- Troubleshooting lengkap

---

**Total Waktu:** 5 menit  
**Biaya:** Gratis (25,000 requests/month)  
**Akurasi:** 70-85% (tergantung kualitas foto)
