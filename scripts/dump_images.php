<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$images = \App\Models\Image::all()->toArray();
$firstProductUrl = \App\Models\Product::first()?->first_image_url;

echo json_encode(['images' => $images, 'first_product_first_image_url' => $firstProductUrl], JSON_PRETTY_PRINT);
