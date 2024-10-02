<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Products\FetchExternalProductsService;

class FetchExternalProductsCommand extends Command
{
    private FetchExternalProductsService $service;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'fetch products command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(FetchExternalProductsService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->service->fetchProducts();
    }
}
