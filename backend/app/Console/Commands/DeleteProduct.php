<?php

namespace App\Console\Commands;

use App\Services\ProductService;
use Illuminate\Console\Command;

class DeleteProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a single product';

    /**
     * Execute the console command.
     */
    public function handle(ProductService $service)
    {
        $productId = $this->ask('Product ID');

        $product = $service->findProductById($productId);
        
        if ($product) {
            $service->deleteProduct($product);
            $this->info('Product deleted successfully.');
        } else {
            $this->error('Product not found.');
        }
    }
}
