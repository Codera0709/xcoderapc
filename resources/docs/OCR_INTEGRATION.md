# Integrasi OCR untuk KTP

## Overview
File ini menjelaskan cara mengintegrasikan OCR (Optical Character Recognition) untuk ekstraksi data KTP secara otomatis.

## Opsi OCR yang Tersedia

### 1. Google Cloud Vision API (Recommended)
**Kelebihan:**
- Akurasi tinggi untuk teks Indonesia
- Support berbagai format gambar
- Mudah diintegrasikan

**Cara Setup:**
```bash
composer require google/cloud-vision
```

**Konfigurasi:**
1. Buat project di Google Cloud Console
2. Enable Vision API
3. Download service account JSON key
4. Simpan di `storage/app/google-vision-key.json`
5. Set environment variable:
```env
GOOGLE_APPLICATION_CREDENTIALS=storage/app/google-vision-key.json
```

**Implementasi di Controller:**
```php
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

private function processOCR($file)
{
    $imageAnnotator = new ImageAnnotatorClient([
        'credentials' => storage_path('app/google-vision-key.json')
    ]);
    
    $image = file_get_contents($file->getRealPath());
    $response = $imageAnnotator->textDetection($image);
    $texts = $response->getTextAnnotations();
    
    if ($texts) {
        $fullText = $texts[0]->getDescription();
        return $this->parseKTPText($fullText);
    }
    
    return [];
}

private function parseKTPText($text)
{
    // Parse text hasil OCR menjadi field KTP
    $data = [];
    
    // Extract NIK (16 digit)
    if (preg_match('/(\d{16})/', $text, $matches)) {
        $data['nik'] = $matches[1];
    }
    
    // Extract Nama
    if (preg_match('/Nama\s*:?\s*([^\n]+)/i', $text, $matches)) {
        $data['nama_lengkap'] = trim($matches[1]);
    }
    
    // Extract Tempat/Tgl Lahir
    if (preg_match('/Tempat.*Lahir\s*:?\s*([^,]+),\s*(\d{2}-\d{2}-\d{4})/i', $text, $matches)) {
        $data['tempat_lahir'] = trim($matches[1]);
        $data['tanggal_lahir'] = date('Y-m-d', strtotime($matches[2]));
    }
    
    // Extract Jenis Kelamin
    if (preg_match('/Jenis.*Kelamin\s*:?\s*(LAKI-LAKI|PEREMPUAN)/i', $text, $matches)) {
        $data['jenis_kelamin'] = ucwords(strtolower($matches[1]));
    }
    
    // Extract Alamat
    if (preg_match('/Alamat\s*:?\s*([^\n]+)/i', $text, $matches)) {
        $data['alamat'] = trim($matches[1]);
    }
    
    // Extract RT/RW
    if (preg_match('/RT\/RW\s*:?\s*(\d+)\/(\d+)/i', $text, $matches)) {
        $data['rt'] = $matches[1];
        $data['rw'] = $matches[2];
    }
    
    // Extract Kel/Desa
    if (preg_match('/Kel.*Desa\s*:?\s*([^\n]+)/i', $text, $matches)) {
        $data['kelurahan'] = trim($matches[1]);
    }
    
    // Extract Kecamatan
    if (preg_match('/Kecamatan\s*:?\s*([^\n]+)/i', $text, $matches)) {
        $data['kecamatan'] = trim($matches[1]);
    }
    
    // Extract Agama
    if (preg_match('/Agama\s*:?\s*([^\n]+)/i', $text, $matches)) {
        $data['agama'] = trim($matches[1]);
    }
    
    // Extract Status Perkawinan
    if (preg_match('/Status.*Perkawinan\s*:?\s*([^\n]+)/i', $text, $matches)) {
        $data['status_perkawinan'] = trim($matches[1]);
    }
    
    // Extract Pekerjaan
    if (preg_match('/Pekerjaan\s*:?\s*([^\n]+)/i', $text, $matches)) {
        $data['pekerjaan'] = trim($matches[1]);
    }
    
    // Extract Kewarganegaraan
    if (preg_match('/Kewarganegaraan\s*:?\s*([^\n]+)/i', $text, $matches)) {
        $data['kewarganegaraan'] = trim($matches[1]);
    }
    
    return $data;
}
```

### 2. Tesseract OCR (Free, Self-hosted)
**Kelebihan:**
- Gratis dan open source
- Tidak perlu koneksi internet
- Privacy terjaga

**Cara Setup:**
```bash
# Install Tesseract
# Windows: Download dari https://github.com/UB-Mannheim/tesseract/wiki
# Linux: sudo apt-get install tesseract-ocr tesseract-ocr-ind

composer require thiagoalessio/tesseract_ocr
```

**Implementasi:**
```php
use thiagoalessio\TesseractOCR\TesseractOCR;

private function processOCR($file)
{
    $ocr = new TesseractOCR($file->getRealPath());
    $ocr->lang('ind'); // Indonesian language
    $text = $ocr->run();
    
    return $this->parseKTPText($text);
}
```

### 3. OCR.space API (Free tier available)
**Kelebihan:**
- Free tier 25,000 requests/month
- Mudah digunakan
- Tidak perlu setup server

**Cara Setup:**
```bash
# Daftar di https://ocr.space/ocrapi untuk mendapatkan API key
```

**Implementasi:**
```php
private function processOCR($file)
{
    $apiKey = env('OCR_SPACE_API_KEY');
    
    $response = Http::attach(
        'file', file_get_contents($file->getRealPath()), 'ktp.jpg'
    )->post('https://api.ocr.space/parse/image', [
        'apikey' => $apiKey,
        'language' => 'ind',
    ]);
    
    $result = $response->json();
    
    if ($result['IsErroredOnProcessing'] == false) {
        $text = $result['ParsedResults'][0]['ParsedText'];
        return $this->parseKTPText($text);
    }
    
    return [];
}
```

## Testing
Untuk testing tanpa OCR, function `processOCR` di controller sudah return dummy data yang bisa diisi manual.

## Rekomendasi
1. **Development**: Gunakan dummy data atau OCR.space free tier
2. **Production**: Gunakan Google Cloud Vision API untuk akurasi terbaik
3. **Self-hosted**: Gunakan Tesseract jika privacy adalah prioritas

## Notes
- Pastikan gambar KTP yang diupload memiliki kualitas yang baik
- Pencahayaan yang cukup akan meningkatkan akurasi OCR
- Hasil OCR tetap perlu verifikasi manual oleh user
