<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Debug OCR Configuration ===\n\n";

// Check .env
echo "1. Checking .env file:\n";
$envContent = file_get_contents(__DIR__.'/.env');
if (strpos($envContent, 'OCR_SPACE_API_KEY') !== false) {
    preg_match('/OCR_SPACE_API_KEY=(.+)/', $envContent, $matches);
    $apiKey = trim($matches[1] ?? '');
    echo "   ✅ OCR_SPACE_API_KEY found in .env: " . substr($apiKey, 0, 5) . "...\n";
} else {
    echo "   ❌ OCR_SPACE_API_KEY NOT found in .env\n";
}

// Check env()
echo "\n2. Checking env() function:\n";
$envValue = env('OCR_SPACE_API_KEY');
if ($envValue) {
    echo "   ✅ env('OCR_SPACE_API_KEY'): " . substr($envValue, 0, 5) . "...\n";
} else {
    echo "   ❌ env('OCR_SPACE_API_KEY'): NULL\n";
}

// Check config()
echo "\n3. Checking config() function:\n";
$configValue = config('services.ocr_space.api_key');
if ($configValue) {
    echo "   ✅ config('services.ocr_space.api_key'): " . substr($configValue, 0, 5) . "...\n";
} else {
    echo "   ❌ config('services.ocr_space.api_key'): NULL\n";
}

// Check config cache
echo "\n4. Checking config cache:\n";
$configCachePath = __DIR__.'/bootstrap/cache/config.php';
if (file_exists($configCachePath)) {
    echo "   ⚠️  Config is CACHED\n";
    echo "   Run: php artisan config:clear\n";
} else {
    echo "   ✅ Config is NOT cached\n";
}

// Check KTPOCRService
echo "\n5. Checking KTPOCRService:\n";
$serviceContent = file_get_contents(__DIR__.'/app/Services/KTPOCRService.php');
if (strpos($serviceContent, 'return $this->ocrSpaceExtract($file);') !== false) {
    echo "   ✅ Service is using ocrSpaceExtract()\n";
} elseif (strpos($serviceContent, 'return $this->dummyExtract();') !== false && 
          strpos($serviceContent, '// return $this->dummyExtract();') === false) {
    echo "   ❌ Service is using dummyExtract() - STILL DUMMY!\n";
} else {
    echo "   ⚠️  Cannot determine which method is active\n";
}

echo "\n=== Summary ===\n";
if ($configValue && strpos($serviceContent, 'return $this->ocrSpaceExtract($file);') !== false) {
    echo "✅ Everything looks good! OCR should work.\n";
    echo "\nIf still showing JOHN DOE:\n";
    echo "1. Clear browser cache (Ctrl+Shift+Delete)\n";
    echo "2. Hard refresh (Ctrl+F5)\n";
    echo "3. Check Laravel log: storage/logs/laravel.log\n";
} else {
    echo "❌ Configuration issue detected!\n";
    echo "\nFix:\n";
    echo "1. Make sure OCR_SPACE_API_KEY is in .env\n";
    echo "2. Run: php artisan config:clear\n";
    echo "3. Check app/Services/KTPOCRService.php line ~33\n";
}

echo "\n";
