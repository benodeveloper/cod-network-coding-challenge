<?php

namespace App\Console\Commands;

use App\Services\CategoryService;
use Illuminate\Console\Command;

class DeleteCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a single category';

    /**
     * Execute the console command.
     */
    public function handle(CategoryService $service)
    {
        $categoryId = $this->ask('Category ID');

        $category = $service->findCategoryById($categoryId);
        
        if ($category) {
            $service->deleteCategory($category);
            $this->info('Category deleted successfully.');
        } else {
            $this->error('Category not found.');
        }
    }
}
