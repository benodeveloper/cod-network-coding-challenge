<?php
namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryRepository
{

    /**
     * Retrive a single category by ID.
     *
     * @param  int  $id
     * @param  array|string  $columns
     * @return mixed|static
     */
    public function findById(int $id,array|string $columns = ['*'])
    {
        return Category::find($id, $columns);
    }

    /**
     * insert a category in the database.
     * 
     * @return Category
     */
    public function create(array $data)
    {
        return Category::create($data);
    }

    /**
     * Delete the category from the database.
     *
     * @return bool|null
     *
     * @throws \LogicException
     */
    public function delete(Category $category)
    {
        return $category->delete();
    }

    /**
     * Paginate the given query into a simple paginator.
     *
     * @param  int|\Closure  $perPage
     * @param  array|string  $columns
     * @param  string  $pageName
     * @param  int|null  $page
     * @param  \Closure|int|null  $total
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 15, array|string $columns = ['*'], string $pageName = 'page',int|null $page = null)
    {
        return Category::paginate($perPage, $columns, $pageName, $page);
    }
}
