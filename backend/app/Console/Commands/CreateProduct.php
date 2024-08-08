<?php

namespace App\Console\Commands;

use App\Services\ProductService;
use Illuminate\Console\Command;

class CreateProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a single product';

    /**
     * Execute the console command.
     */
    public function handle(ProductService $service)
    {
        $name        = $this->ask('Product name');
        $description = $this->ask('Product description');
        $categoryId  = $this->ask('Category ID');
        $price       = $this->ask('Product price');
        $image       = $this->ask('Product image path');

        $data = [
            'name'        => $name,
            'description' => $description,
            'price'       => $price,
            'image'       => $image,
            'category_id' => $categoryId,
        ];

        $service->validateData($data);
        $service->createProduct($data);

        $this->info('Product created successfully.');
    }
}
