<?php
namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{

    /**
     * Retrive a single product by ID.
     *
     * @param  int  $id
     * @param  array|string  $columns
     * @return mixed|static
     */
    public function findById(int $id, array|string $columns = ['*'])
    {
        return Product::find($id, $columns);
    }

    /**
     * insert a product in the database.
     * 
     * @return Product
     */
    public function create(array $data)
    {
        return Product::create($data);
    }

    /**
     * Delete the product from the database.
     *
     * @return bool|null
     *
     * @throws \LogicException
     */
    public function delete(Product $product)
    {
        return $product->delete();
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
    public function paginate($categoryId = null, $sortBy = null, $order = 'asc', $perPage = 15, $columns = ['*'], $pageName = 'page', $page = null)
    {
        $query = Product::query();

        $query->when($categoryId, function($q) use($categoryId) {
            $q->where('category_id', $categoryId);
        });

        $query->when($sortBy, function($q) use($sortBy, $order) {
            $q->orderBy($sortBy, $order);
        });

        return $query->paginate($perPage, $columns, $pageName, $page);
    }
}
