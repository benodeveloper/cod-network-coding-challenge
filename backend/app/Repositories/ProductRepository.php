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
    public function paginate($perPage = 15, $columns = ['*'], $pageName = 'page', $page = null)
    {
        return Product::paginate($perPage, $columns, $pageName, $page);
    }
}
