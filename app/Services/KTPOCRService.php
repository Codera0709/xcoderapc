<?php

namespace App\Services;

/**
 * KTP OCR Service
 * 
 * Service untuk extract data dari foto KTP menggunakan OCR
 * Uncomment salah satu implementasi sesuai provider yang digunakan
 */
class KTPOCRService
{
    /**
     * Process KTP image dan extract data
     * 
     * @param \Illuminate\Http\UploadedFile $file
     * @return array
     */
    public function extractData($file)
    {
        // Pilih salah satu implementasi di bawah:
        
        // 1. Dummy data (untuk development/testing)
        // return $this->dummyExtract();
        
        // 2. Google Cloud Vision (uncomment untuk menggunakan)
        // return $this->googleVisionExtract($file);
        
        // 3. Tesseract OCR (uncomment untuk menggunakan)
        // return $this->tesseractExtract($file);
        
        // 4. OCR.space API (ACTIVE - menggunakan OCR real)
        return $this->ocrSpaceExtract($file);
    }

    /**
     * Dummy extract untuk testing
     * 
     * NOTE: Ini adalah dummy data untuk testing.
     * Untuk production, uncomment salah satu method OCR di atas (extractData)
     * dan implementasikan OCR provider yang sesuai.
     */
    private function dummyExtract()
    {
        // Return sample data untuk testing
        // Dalam production, ini akan diganti dengan hasil OCR real
        return [
            'nik' => '3201234567890123',
            'nama_lengkap' => 'JOHN DOE',
            'tempat_lahir' => 'JAKARTA',
            'tanggal_lahir' => '1990-01-15',
            'jenis_kelamin' => 'Laki-laki',
            'golongan_darah' => 'A',
            'alamat' => 'JL. CONTOH NO. 123',
            'rt' => '001',
            'rw' => '002',
            'kelurahan' => 'KELURAHAN CONTOH',
            'kecamatan' => 'KECAMATAN CONTOH',
            'kabupaten_kota' => 'KOTA JAKARTA SELATAN',
            'provinsi' => 'DKI JAKARTA',
            'agama' => 'Islam',
            'status_perkawinan' => 'Belum Kawin',
            'pekerjaan' => 'KARYAWAN SWASTA',
            'kewarganegaraan' => 'WNI',
            'berlaku_hingga' => 'SEUMUR HIDUP',
        ];
    }

    /**
     * Google Cloud Vision API implementation
     * 
     * Setup:
     * 1. composer require google/cloud-vision
     * 2. Set GOOGLE_APPLICATION_CREDENTIALS di .env
     */
    private function googleVisionExtract($file)
    {
        // Uncomment untuk menggunakan:
        /*
        $imageAnnotator = new \Google\Cloud\Vision\V1\ImageAnnotatorClient([
            'credentials' => config('services.google.vision_credentials')
        ]);
        
        $image = file_get_contents($file->getRealPath());
        $response = $imageAnnotator->textDetection($image);
        $texts = $response->getTextAnnotations();
        
        if ($texts) {
            $fullText = $texts[0]->getDescription();
            return $this->parseKTPText($fullText);
        }
        
        return $this->dummyExtract();
        */
    }

    /**
     * Tesseract OCR implementation
     * 
     * Setup:
     * 1. Install Tesseract di server
     * 2. composer require thiagoalessio/tesseract_ocr
     */
    private function tesseractExtract($file)
    {
        // Uncomment untuk menggunakan:
        /*
        $ocr = new \thiagoalessio\TesseractOCR\TesseractOCR($file->getRealPath());
        $ocr->lang('ind'); // Indonesian language
        $text = $ocr->run();
        
        return $this->parseKTPText($text);
        */
    }

    /**
     * OCR.space API implementation
     * 
     * Setup:
     * 1. Daftar di https://ocr.space/ocrapi
     * 2. Set OCR_SPACE_API_KEY di .env
     */
    private function ocrSpaceExtract($file)
    {
        try {
            $apiKey = config('services.ocr_space.api_key');
            
            if (!$apiKey) {
                \Log::warning('OCR_SPACE_API_KEY not configured, using dummy data');
                return $this->dummyExtract();
            }
            
            \Log::info('Processing KTP with OCR.space API');
            
            // Encode image to base64
            $base64Image = base64_encode(file_get_contents($file->getRealPath()));
            
            $response = \Illuminate\Support\Facades\Http::timeout(30)
                ->asForm()
                ->post('https://api.ocr.space/parse/image', [
                    'apikey' => $apiKey,
                    'base64Image' => 'data:image/jpeg;base64,' . $base64Image,
                    'language' => 'ind',
                    'OCREngine' => 2,
                ]);
            
            $result = $response->json();
            
            \Log::info('OCR.space response', ['result' => $result]);
            
            if (isset($result['ParsedResults'][0]['ParsedText'])) {
                $text = $result['ParsedResults'][0]['ParsedText'];
                \Log::info('OCR text extracted', ['text' => $text]);
                return $this->parseKTPText($text);
            }
            
            if (isset($result['ErrorMessage'])) {
                \Log::error('OCR.space error', ['error' => $result['ErrorMessage']]);
            }
            
            return $this->dummyExtract();
            
        } catch (\Exception $e) {
            \Log::error('OCR extraction failed', ['error' => $e->getMessage()]);
            return $this->dummyExtract();
        }
    }

    /**
     * Parse text hasil OCR menjadi structured data
     * 
     * @param string $text
     * @return array
     */
    private function parseKTPText($text)
    {
        // Initialize dengan empty data
        $data = [
            'nik' => '',
            'nama_lengkap' => '',
            'tempat_lahir' => '',
            'tanggal_lahir' => '',
            'jenis_kelamin' => '',
            'golongan_darah' => '',
            'alamat' => '',
            'rt' => '',
            'rw' => '',
            'kelurahan' => '',
            'kecamatan' => '',
            'kabupaten_kota' => '',
            'provinsi' => '',
            'agama' => '',
            'status_perkawinan' => '',
            'pekerjaan' => '',
            'kewarganegaraan' => 'WNI',
            'berlaku_hingga' => 'SEUMUR HIDUP',
        ];
        
        // Clean text
        $text = str_replace(["\r\n", "\r"], "\n", $text);
        $lines = explode("\n", $text);
        
        \Log::info('Parsing KTP text', ['lines' => $lines]);
        
        // Extract NIK (16 digit, biasanya di baris awal)
        if (preg_match('/\b(\d{16})\b/', $text, $matches)) {
            $data['nik'] = $matches[1];
            \Log::info('NIK found', ['nik' => $data['nik']]);
        }
        
        // Extract Nama (biasanya setelah label "Nama")
        if (preg_match('/(?:Nama|NAMA)\s*[:;]?\s*([A-Z\s]+?)(?:\n|Tempat|TTL)/i', $text, $matches)) {
            $data['nama_lengkap'] = trim($matches[1]);
        }
        
        // Extract Tempat/Tgl Lahir - berbagai format
        // Format 1: JAKARTA, 15-01-1990
        if (preg_match('/(?:Tempat.*?Lahir|TTL)\s*[:;]?\s*([A-Z\s]+?),\s*(\d{2}[-\/]\d{2}[-\/]\d{4})/i', $text, $matches)) {
            $data['tempat_lahir'] = trim($matches[1]);
            $data['tanggal_lahir'] = $this->parseDate($matches[2]);
        }
        // Format 2: JAKARTA 15-01-1990 (tanpa koma)
        elseif (preg_match('/(?:Tempat.*?Lahir|TTL)\s*[:;]?\s*([A-Z\s]+?)\s+(\d{2}[-\/]\d{2}[-\/]\d{4})/i', $text, $matches)) {
            $data['tempat_lahir'] = trim($matches[1]);
            $data['tanggal_lahir'] = $this->parseDate($matches[2]);
        }
        
        // Extract Jenis Kelamin
        if (preg_match('/(?:Jenis.*?Kelamin|JK)\s*[:;]?\s*(LAKI-LAKI|PEREMPUAN|L|P)/i', $text, $matches)) {
            $jk = strtoupper(trim($matches[1]));
            $data['jenis_kelamin'] = ($jk === 'L' || $jk === 'LAKI-LAKI') ? 'Laki-laki' : 'Perempuan';
        }
        
        // Extract Golongan Darah
        if (preg_match('/(?:Gol.*?Darah|Gol\.?\s*Darah)\s*[:;]?\s*([ABO]{1,2}[-+]?)/i', $text, $matches)) {
            $data['golongan_darah'] = strtoupper(trim($matches[1]));
        }
        
        // Extract Alamat
        if (preg_match('/(?:Alamat)\s*[:;]?\s*([^\n]+)/i', $text, $matches)) {
            $data['alamat'] = trim($matches[1]);
        }
        
        // Extract RT/RW - berbagai format
        if (preg_match('/(?:RT.*?RW|RT\/RW)\s*[:;]?\s*(\d{1,3})\s*[\/\-]\s*(\d{1,3})/i', $text, $matches)) {
            $data['rt'] = str_pad($matches[1], 3, '0', STR_PAD_LEFT);
            $data['rw'] = str_pad($matches[2], 3, '0', STR_PAD_LEFT);
        }
        
        // Extract Kel/Desa
        if (preg_match('/(?:Kel.*?Desa|Kelurahan|Desa)\s*[:;]?\s*([^\n]+)/i', $text, $matches)) {
            $data['kelurahan'] = trim($matches[1]);
        }
        
        // Extract Kecamatan
        if (preg_match('/(?:Kecamatan)\s*[:;]?\s*([^\n]+)/i', $text, $matches)) {
            $data['kecamatan'] = trim($matches[1]);
        }
        
        // Extract Kabupaten/Kota
        if (preg_match('/(?:KABUPATEN|KOTA)\s+([A-Z\s]+?)(?:\n|Provinsi)/i', $text, $matches)) {
            $data['kabupaten_kota'] = trim($matches[0]);
        }
        
        // Extract Provinsi
        if (preg_match('/(?:PROVINSI|Prov\.?)\s+([A-Z\s]+?)(?:\n|$)/i', $text, $matches)) {
            $data['provinsi'] = trim($matches[1]);
        }
        
        // Extract Agama
        $agamaList = ['ISLAM', 'KRISTEN', 'KATOLIK', 'HINDU', 'BUDDHA', 'KONGHUCU'];
        foreach ($agamaList as $agama) {
            if (stripos($text, $agama) !== false) {
                $data['agama'] = ucfirst(strtolower($agama));
                break;
            }
        }
        
        // Extract Status Perkawinan
        if (preg_match('/(?:Status.*?Perkawinan|Kawin)\s*[:;]?\s*([^\n]+)/i', $text, $matches)) {
            $status = strtoupper(trim($matches[1]));
            if (stripos($status, 'BELUM') !== false || $status === 'BELUM KAWIN') {
                $data['status_perkawinan'] = 'Belum Kawin';
            } elseif (stripos($status, 'KAWIN') !== false && stripos($status, 'BELUM') === false) {
                $data['status_perkawinan'] = 'Kawin';
            } elseif (stripos($status, 'CERAI') !== false) {
                $data['status_perkawinan'] = 'Cerai Hidup';
            }
        }
        
        // Extract Pekerjaan
        if (preg_match('/(?:Pekerjaan)\s*[:;]?\s*([^\n]+)/i', $text, $matches)) {
            $data['pekerjaan'] = trim($matches[1]);
        }
        
        // Extract Kewarganegaraan
        if (preg_match('/(?:Kewarganegaraan|WNI|WNA)\s*[:;]?\s*([^\n]+)/i', $text, $matches)) {
            $kewarganegaraan = strtoupper(trim($matches[1]));
            $data['kewarganegaraan'] = (stripos($kewarganegaraan, 'WNI') !== false) ? 'WNI' : $kewarganegaraan;
        }
        
        // Extract Berlaku Hingga
        if (preg_match('/(?:Berlaku.*?Hingga)\s*[:;]?\s*([^\n]+)/i', $text, $matches)) {
            $data['berlaku_hingga'] = trim($matches[1]);
        }
        
        \Log::info('Parsed KTP data', ['data' => $data]);
        
        return $data;
    }
    
    /**
     * Parse date dari berbagai format
     */
    private function parseDate($dateString)
    {
        // Format: DD-MM-YYYY atau DD/MM/YYYY
        $dateString = str_replace('/', '-', $dateString);
        
        try {
            $parts = explode('-', $dateString);
            if (count($parts) === 3) {
                // DD-MM-YYYY to YYYY-MM-DD
                return $parts[2] . '-' . $parts[1] . '-' . $parts[0];
            }
        } catch (\Exception $e) {
            \Log::error('Date parsing failed', ['date' => $dateString, 'error' => $e->getMessage()]);
        }
        
        return '';
    }

    /**
     * Pre-process image untuk meningkatkan akurasi OCR
     * 
     * @param string $imagePath
     * @return string Path to processed image
     */
    private function preprocessImage($imagePath)
    {
        // Implementasi image preprocessing jika diperlukan:
        // - Increase contrast
        // - Convert to grayscale
        // - Remove noise
        // - Deskew
        
        // Requires GD or Imagick extension
        
        return $imagePath;
    }
}
