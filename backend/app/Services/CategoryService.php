<?php
namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CategoryService
{
    protected $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Validate the provided category data.
     *
     * @param  array  $data  The category data to be validated.
     * 
     * @throws \Illuminate\Validation\ValidationException If validation fails.
     * 
     * @return void
     */
    public function validateData(array $data)
    {
        $validator = Validator::make($data, [
            'name'      => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    /**
     * Retrive a single category by ID.
     *
     * @param  int  $id
     * @param  array|string  $columns
     * @return mixed|static
     */
    public function findCategoryById(int $id)
    {
        return $this->repository->findById($id);
    }

    /**
     * Create a single category.
     * 
     * @return Category
     */
    public function createCategory(array $data)
    {
        return $this->repository->create($data);
    }

    /**
     * Delete a single category.
     *
     * @return bool|null
     *
     * @throws \LogicException
     */
    public function deleteCategory(Category $category)
    {
        return $this->repository->delete($category);
    }

    /**
     * Paginate all the categories with a give pagination params
     * 
     * @param  int|\Closure  $perPage
     * @param  array|string  $columns
     * @param  string  $pageName
     * @param  int|null  $page
     * @param  \Closure|int|null  $total
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function listCategories(int $perPage = 15, array|string $columns = ['*'], string $pageName = 'page',int|null $page = null)
    {
        return $this->repository->paginate($perPage, $columns, $pageName, $page);
    }
}
