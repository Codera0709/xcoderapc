# Testing Checklist - SLIK Data Feature

## Pre-Testing Setup

- [ ] Pastikan server Laravel sudah running
- [ ] Database sudah terkoneksi
- [ ] Storage link sudah dibuat (`php artisan storage:link`)
- [ ] Login ke aplikasi dengan user yang valid

## 1. Navigation Menu

### Desktop View
- [ ] Menu "SLIK Data" muncul di navigation bar
- [ ] Menu aktif (highlighted) saat di halaman SLIK
- [ ] Klik menu redirect ke `/slik`

### Mobile View
- [ ] Hamburger menu berfungsi
- [ ] Menu "SLIK Data" muncul di responsive menu
- [ ] Klik menu redirect dengan benar

## 2. List Data SLIK (Index Page)

### Tampilan
- [ ] Halaman `/slik` dapat diakses
- [ ] Header "SLIK Data" muncul
- [ ] Button "Tambah Data Baru" terlihat
- [ ] Table dengan kolom: NIK, Nama, Tempat/Tgl Lahir, Alamat, Aksi

### Functionality
- [ ] Jika belum ada data, muncul pesan "Belum ada data SLIK"
- [ ] Jika ada data, data ditampilkan di table
- [ ] Pagination muncul jika data > 10
- [ ] Button "Edit" berfungsi
- [ ] Button "Hapus" berfungsi dengan konfirmasi
- [ ] Success message muncul setelah create/update/delete

## 3. Upload KTP & Create Data

### Upload Section
- [ ] Halaman `/slik/create` dapat diakses
- [ ] Upload area terlihat dengan icon dan text
- [ ] Klik upload area membuka file picker
- [ ] Hanya accept file image (JPG, PNG, JPEG)
- [ ] File > 5MB ditolak dengan error message

### Preview & Process
- [ ] Setelah pilih file, preview gambar muncul
- [ ] Button "Proses KTP" menjadi enabled
- [ ] Klik "Proses KTP" menampilkan loading indicator
- [ ] Loading indicator hilang setelah processing selesai
- [ ] Form data muncul setelah processing

### Form Input
- [ ] Semua field form terlihat dengan label yang jelas
- [ ] Field NIK: maxlength 16 digit
- [ ] Field Jenis Kelamin: dropdown dengan 2 pilihan
- [ ] Field Golongan Darah: dropdown dengan 4 pilihan
- [ ] Field Agama: dropdown dengan 6 pilihan
- [ ] Field Status Perkawinan: dropdown dengan 4 pilihan
- [ ] Field Tanggal Lahir: date picker
- [ ] Field RT/RW: maxlength 3 digit
- [ ] Default value "WNI" untuk Kewarganegaraan
- [ ] Default value "SEUMUR HIDUP" untuk Berlaku Hingga

### Validation
- [ ] Submit form kosong menampilkan error
- [ ] NIK harus 16 digit
- [ ] NIK duplicate ditolak dengan error
- [ ] Email format harus valid (jika ada)
- [ ] Required field ditandai dengan *
- [ ] Error message muncul di bawah field yang error

### Submit
- [ ] Button "Simpan Data" berfungsi
- [ ] Loading state saat submit
- [ ] Redirect ke `/slik` setelah berhasil
- [ ] Success message "Data SLIK berhasil disimpan" muncul
- [ ] Data baru muncul di list

### Cancel
- [ ] Button "Batal" redirect ke `/slik`
- [ ] Data tidak tersimpan jika cancel

## 4. Edit Data

### Tampilan
- [ ] Halaman `/slik/{id}/edit` dapat diakses
- [ ] Header "Edit Data SLIK" muncul
- [ ] Form pre-filled dengan data existing
- [ ] Semua field dapat diedit

### Validation
- [ ] Validation sama seperti create
- [ ] NIK boleh sama dengan data sendiri
- [ ] NIK tidak boleh sama dengan data lain

### Submit
- [ ] Button "Update Data" berfungsi
- [ ] Redirect ke `/slik` setelah berhasil
- [ ] Success message "Data SLIK berhasil diupdate" muncul
- [ ] Data terupdate di list

### Cancel
- [ ] Button "Batal" redirect ke `/slik`
- [ ] Data tidak berubah jika cancel

## 5. Delete Data

### Confirmation
- [ ] Klik button "Hapus" menampilkan konfirmasi
- [ ] Text konfirmasi: "Yakin ingin menghapus data ini?"
- [ ] Ada option Cancel dan OK

### Delete Action
- [ ] Klik OK menghapus data
- [ ] Redirect ke `/slik`
- [ ] Success message "Data SLIK berhasil dihapus" muncul
- [ ] Data hilang dari list
- [ ] Data di-soft delete (masih ada di database dengan deleted_at)

### Cancel Delete
- [ ] Klik Cancel tidak menghapus data
- [ ] Data masih ada di list

## 6. Responsive Design

### Mobile (< 640px)
- [ ] Layout responsive
- [ ] Table scrollable horizontal
- [ ] Form fields stack vertical
- [ ] Buttons ukuran sesuai
- [ ] Upload area ukuran sesuai

### Tablet (640px - 1024px)
- [ ] Layout responsive
- [ ] Grid 2 kolom untuk form
- [ ] Navigation collapse ke hamburger

### Desktop (> 1024px)
- [ ] Layout full width dengan max-width
- [ ] Grid 2 kolom untuk form
- [ ] Navigation horizontal

## 7. Security

### Authentication
- [ ] Halaman tidak bisa diakses tanpa login
- [ ] Redirect ke login jika belum auth
- [ ] Setelah login, redirect ke halaman yang diminta

### Authorization
- [ ] User hanya bisa edit/delete data sendiri (jika ada role)
- [ ] CSRF token valid di semua form

### File Upload
- [ ] File type validation berfungsi
- [ ] File size validation berfungsi
- [ ] File disimpan di storage/app/public/ktp_uploads
- [ ] File accessible via /storage/ktp_uploads/

## 8. Error Handling

### Network Error
- [ ] Error message muncul jika upload gagal
- [ ] Error message muncul jika OCR processing gagal
- [ ] User bisa retry

### Validation Error
- [ ] Error message jelas dan spesifik
- [ ] Error muncul di field yang bermasalah
- [ ] Form tidak reset saat ada error

### Server Error
- [ ] 500 error ditangani dengan graceful
- [ ] Error message user-friendly

## 9. Performance

### Page Load
- [ ] Halaman load < 2 detik
- [ ] No console errors
- [ ] No console warnings (kecuali dari library)

### Upload
- [ ] Preview muncul instant setelah pilih file
- [ ] Processing time reasonable (< 5 detik)

### Form Submit
- [ ] Submit response < 2 detik
- [ ] No lag saat typing

## 10. Browser Compatibility

- [ ] Chrome (latest)
- [ ] Firefox (latest)
- [ ] Edge (latest)
- [ ] Safari (latest) - jika ada Mac

## 11. Data Integrity

### Database
- [ ] Data tersimpan dengan benar di tabel persons
- [ ] NIK unique constraint berfungsi
- [ ] Soft delete berfungsi (deleted_at)
- [ ] Timestamps (created_at, updated_at) terupdate

### File Storage
- [ ] File KTP tersimpan di storage
- [ ] File path tersimpan di database (jika ada field)
- [ ] File tidak corrupt

## Bug Report Template

Jika menemukan bug, catat dengan format:

```
**Bug Title**: [Judul singkat]

**Steps to Reproduce**:
1. 
2. 
3. 

**Expected Result**: 
[Apa yang seharusnya terjadi]

**Actual Result**: 
[Apa yang terjadi]

**Screenshot**: 
[Attach screenshot jika ada]

**Browser**: [Chrome/Firefox/etc]
**Device**: [Desktop/Mobile/Tablet]
**Priority**: [High/Medium/Low]
```

## Testing Status

- [ ] All tests passed
- [ ] Bugs found: ___
- [ ] Bugs fixed: ___
- [ ] Ready for production: Yes / No

---

**Tester**: _______________  
**Date**: _______________  
**Version**: 1.0.0
