<?php
/**
 * Test OCR.space API
 * 
 * Jalankan: php test-ocr-api.php
 */

require __DIR__.'/vendor/autoload.php';

// Load .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$apiKey = $_ENV['OCR_SPACE_API_KEY'] ?? null;

echo "=== Test OCR.space API ===\n\n";

if (!$apiKey) {
    echo "❌ ERROR: OCR_SPACE_API_KEY tidak ditemukan di .env\n";
    exit(1);
}

echo "✅ API Key ditemukan: " . substr($apiKey, 0, 5) . "...\n\n";

// Test dengan sample image URL
echo "Testing dengan sample image...\n";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.ocr.space/parse/image');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, [
    'apikey' => $apiKey,
    'url' => 'https://ocr.space/Content/Images/receipt-ocr-original.jpg',
    'language' => 'eng',
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Code: $httpCode\n";

if ($httpCode === 200) {
    $result = json_decode($response, true);
    
    if (isset($result['IsErroredOnProcessing']) && $result['IsErroredOnProcessing'] === false) {
        echo "✅ SUCCESS: OCR API berfungsi dengan baik!\n\n";
        echo "Sample text extracted:\n";
        echo substr($result['ParsedResults'][0]['ParsedText'], 0, 200) . "...\n\n";
        echo "✅ API Key valid dan siap digunakan!\n";
    } else {
        echo "❌ ERROR: " . ($result['ErrorMessage'][0] ?? 'Unknown error') . "\n";
        echo "Response: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";
    }
} else {
    echo "❌ ERROR: HTTP $httpCode\n";
    echo "Response: $response\n";
}

echo "\n=== Test Selesai ===\n";
