<?php

use Illuminate\Support\Facades\Route;
use App\Services\KTPOCRService;

Route::get('/test-ocr-config', function() {
    $apiKey = config('services.ocr_space.api_key');
    
    return response()->json([
        'api_key_exists' => !empty($apiKey),
        'api_key_preview' => $apiKey ? substr($apiKey, 0, 5) . '...' : 'NOT SET',
        'env_value' => env('OCR_SPACE_API_KEY') ? substr(env('OCR_SPACE_API_KEY'), 0, 5) . '...' : 'NOT SET',
        'config_cached' => file_exists(base_path('bootstrap/cache/config.php')),
    ]);
});

Route::get('/test-ocr-service', function() {
    $service = new KTPOCRService();
    
    // Create dummy uploaded file
    $testImagePath = public_path('test-ktp-sample.jpg');
    
    if (!file_exists($testImagePath)) {
        return response()->json([
            'error' => 'Test image not found. Please upload a test KTP image to public/test-ktp-sample.jpg'
        ]);
    }
    
    $file = new \Illuminate\Http\UploadedFile(
        $testImagePath,
        'test-ktp.jpg',
        'image/jpeg',
        null,
        true
    );
    
    try {
        $result = $service->extractData($file);
        
        return response()->json([
            'success' => true,
            'data' => $result,
            'is_dummy' => ($result['nama_lengkap'] === 'JOHN DOE'),
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);
    }
});
