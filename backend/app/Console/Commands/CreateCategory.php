<?php

namespace App\Console\Commands;

use App\Services\CategoryService;
use Illuminate\Console\Command;

class CreateCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a single catogory';

    /**
     * Execute the console command.
     */
    public function handle(CategoryService $service)
    {
        $name     = $this->ask('Category name');
        $parentId = $this->ask('Parent category ID (optional)');

        $data = ['name' => $name, 'parent_id' => $parentId];
        $service->validateData($data);

        $service->createCategory($data);

        $this->info('Category created successfully.');
    }
}
