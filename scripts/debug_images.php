<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$product = \App\Models\Product::first();
echo "=== Product Debug ===\n";
echo "Product ID: " . ($product->id ?? 'none') . "\n";
echo "Product Name: " . ($product->name ?? 'none') . "\n";

if ($product) {
    echo "\n=== Product Images ===\n";
    echo "Images count: " . $product->images()->count() . "\n";
    $product->images()->each(function($img) {
        echo "  - ID: {$img->id}, path: {$img->path}, is_primary: {$img->is_primary}\n";
    });
    
    echo "\n=== Accessor Test ===\n";
    echo "first_image_url: " . ($product->first_image_url ?? 'NULL') . "\n";
    echo "first_image_url (via getAttribute): " . ($product->getAttribute('first_image_url') ?? 'NULL') . "\n";
    
    echo "\n=== Direct Query ===\n";
    $image = $product->images()->orderByDesc('is_primary')->first();
    echo "First image from query: " . ($image ? "path={$image->path}, is_primary={$image->is_primary}" : 'none') . "\n";
    if ($image) {
        echo "Constructed URL: /storage/{$image->path}\n";
    }
} else {
    echo "No products found!\n";
}
