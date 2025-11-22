# Instruksi Test Upload KTP dengan OCR Real

## ✅ Status: API Key Sudah Aktif!

API Key Anda sudah terpasang dan berfungsi dengan baik.

---

## 🧪 Cara Test

### 1. Akses Halaman Upload
```
http://localhost/slik/create
```

### 2. Siapkan Foto KTP

**Tips untuk hasil terbaik:**
- ✅ Foto KTP yang jelas (tidak blur)
- ✅ Pencahayaan cukup
- ✅ KTP dalam posisi horizontal
- ✅ Seluruh KTP terlihat (tidak terpotong)
- ✅ Resolusi minimal 1000x600 pixels
- ✅ Format JPG atau PNG
- ✅ Ukuran 500KB - 2MB

**Hindari:**
- ❌ Foto blur atau gelap
- ❌ Ada bayangan atau refleksi
- ❌ KTP miring atau terbalik
- ❌ Background ramai

### 3. Upload dan Proses

1. Klik area upload atau drag & drop foto KTP
2. Preview akan muncul
3. Klik tombol **"Proses KTP"**
4. Tunggu loading (5-10 detik)
5. Form akan muncul dengan data terisi

### 4. Verifikasi Hasil

**Cek field yang terisi:**
- [ ] NIK (16 digit)
- [ ] Nama Lengkap
- [ ] Tempat Lahir
- [ ] Tanggal Lahir
- [ ] Jenis Kelamin
- [ ] Alamat
- [ ] RT/RW
- [ ] Kelurahan
- [ ] Kecamatan
- [ ] Kabupaten/Kota
- [ ] Provinsi
- [ ] Agama
- [ ] Status Perkawinan
- [ ] Pekerjaan
- [ ] Kewarganegaraan

**Field yang terisi akan memiliki background hijau.**

### 5. Koreksi Manual

OCR tidak 100% akurat, jadi:
1. Periksa semua data
2. Koreksi jika ada yang salah
3. Lengkapi field yang kosong
4. Klik **"Simpan Data"**

---

## 🔍 Debugging

### Cek Browser Console

Tekan **F12** untuk membuka Developer Tools, lalu:

1. Klik tab **Console**
2. Upload KTP dan klik "Proses KTP"
3. Lihat log yang muncul:

```javascript
Response: {success: true, data: {...}}
Data received: {nik: "...", nama: "..."}
Field nik: <input> Value: 3201234567890123
Field nama_lengkap: <input> Value: JOHN DOE
...
Populated 15 fields
```

### Cek Laravel Log

Buka file log:
```
storage/logs/laravel.log
```

Atau via command:
```bash
type storage\logs\laravel.log | findstr /i "ocr"
```

Log akan menampilkan:
```
[2025-11-21 16:00:00] local.INFO: Processing KTP with OCR.space API
[2025-11-21 16:00:05] local.INFO: OCR.space response {"result": {...}}
[2025-11-21 16:00:05] local.INFO: OCR text extracted {"text": "..."}
[2025-11-21 16:00:05] local.INFO: Parsing KTP text {"lines": [...]}
[2025-11-21 16:00:05] local.INFO: Parsed KTP data {"data": {...}}
```

---

## ⚠️ Troubleshooting

### Problem: Data tidak terisi sama sekali

**Kemungkinan:**
1. Foto KTP tidak jelas
2. OCR tidak bisa baca text
3. Format KTP berbeda

**Solusi:**
1. Cek Laravel log untuk error
2. Cek browser console
3. Coba foto KTP yang lebih jelas
4. Upload foto KTP lain

**Cek log:**
```bash
type storage\logs\laravel.log
```

### Problem: Beberapa field tidak terisi

**Status:** ✅ Normal behavior

**Penjelasan:**
- OCR tidak 100% akurat
- Beberapa field mungkin tidak terbaca
- User harus isi manual

**Solusi:**
- Lengkapi field yang kosong secara manual
- Ini adalah expected behavior

### Problem: Data salah/typo

**Status:** ✅ Normal behavior

**Penjelasan:**
- OCR bisa salah baca huruf/angka
- Contoh: "O" dibaca "0", "I" dibaca "1"

**Solusi:**
- User harus verifikasi dan koreksi manual
- Ini adalah expected behavior

### Problem: Error "Invalid API Key"

**Solusi:**
1. Cek API key di `.env`
2. Pastikan tidak ada spasi
3. Run: `php artisan config:clear`
4. Test lagi

### Problem: Timeout/Loading lama

**Kemungkinan:**
1. File terlalu besar
2. Koneksi internet lambat
3. OCR.space server lambat

**Solusi:**
1. Compress foto KTP (max 2MB)
2. Cek koneksi internet
3. Tunggu dan retry

---

## 📊 Expected Accuracy

### Akurasi OCR.space:

| Field | Akurasi |
|-------|---------|
| NIK | 90-95% |
| Nama | 85-90% |
| Tempat Lahir | 80-85% |
| Tanggal Lahir | 85-90% |
| Jenis Kelamin | 90-95% |
| Alamat | 70-80% |
| RT/RW | 75-85% |
| Kelurahan | 75-85% |
| Kecamatan | 75-85% |
| Agama | 85-90% |
| Pekerjaan | 80-85% |

**Note:** Akurasi sangat tergantung kualitas foto!

---

## ✅ Success Criteria

Test dianggap berhasil jika:

- [x] API Key valid (sudah ditest ✅)
- [ ] Upload foto KTP berhasil
- [ ] Loading indicator muncul
- [ ] Form muncul setelah processing
- [ ] Minimal 10 field terisi
- [ ] Field yang terisi ada background hijau
- [ ] Data bisa disimpan ke database

---

## 🎯 Next Steps

Setelah test berhasil:

1. **Test dengan berbagai foto KTP**
   - KTP lama vs baru
   - Berbagai provinsi
   - Berbagai kualitas foto

2. **Fine-tune parsing**
   - Jika ada field yang sering tidak terisi
   - Update regex di `parseKTPText()`

3. **User Training**
   - Ajarkan user cara foto KTP yang baik
   - Jelaskan bahwa verifikasi manual tetap perlu

4. **Monitor Usage**
   - Free tier: 25,000 requests/month
   - Monitor di dashboard OCR.space

---

## 📞 Support

Jika ada masalah:

1. Screenshot error di browser console
2. Copy Laravel log error
3. Screenshot hasil OCR
4. Kirim ke tim development

---

**Status:** ✅ Ready to Test  
**API Key:** Active  
**OCR Provider:** OCR.space  
**Free Tier:** 25,000 requests/month  
**Last Updated:** 21 November 2025
