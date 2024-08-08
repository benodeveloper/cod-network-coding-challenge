<?php
namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductService
{
    protected $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

     /**
     * Validate the provided product data.
     *
     * @param  array  $data  The product data to be validated.
     * 
     * @throws \Illuminate\Validation\ValidationException If validation fails.
     * 
     * @return void
     */
    public function validateData(array $data)
    {
        $validator = Validator::make($data, [
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|image|max:1024',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
     }

     /**
      * Retrive a single product by ID.
      *
      * @param  int  $id
      * @param  array|string  $columns
      * @return mixed|static
      */
     public function findProductById(int $id)
     {
         return $this->repository->findById($id);
     }

    /**
     * Create a single product.
     * 
     * @return Product
     */
    public function createProduct(array $data)
    {
        return $this->repository->create($data);
    }

    /**
     * Delete a single product.
     *
     * @return bool|null
     *
     * @throws \LogicException
     */
    public function deleteProduct(Product $product)
    {
        return $this->repository->delete($product);
    }

    /**
     * Paginate all the products with a give pagination params
     * 
     * @param  int|\Closure  $perPage
     * @param  array|string  $columns
     * @param  string  $pageName
     * @param  int|null  $page
     * @param  \Closure|int|null  $total
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function listProducts($perPage = 15, $columns = ['*'], $pageName = 'page', $page = null)
    {
        return $this->repository->paginate($perPage, $columns, $pageName, $page);
    }
}
