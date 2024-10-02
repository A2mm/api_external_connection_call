<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Services\Products\FetchExternalProductsService;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Artisan::command('fetch:products', function () {

    $this->comment('Starting to fetch products...');
    $productService = app(FetchExternalProductsService::class);
    try {
        $productService->fetchProducts();
        $this->comment('Products being fetched successfully.');
    } catch (\Exception $e) {
        $this->error('Failed to fetch products: ' . $e->getMessage());
    }
    $this->comment('Products fetched successfully.');
})->purpose('fetch products')->hourly();
