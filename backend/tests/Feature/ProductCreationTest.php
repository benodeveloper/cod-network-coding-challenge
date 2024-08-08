<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductCreationTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * Test creating a product successfully.
     *
     * @return void
     */
    public function testCreateProductSuccess()
    {
        // Create a category to associate with the product
        $category = Category::factory()->create();

        // Product data
        $data = [
            'name'        => $this->faker->word,
            'description' => $this->faker->sentence,
            'price'       => $this->faker->randomFloat(2, 10, 1000),
            'category_id' => $category->id,
        ];

        // Send a POST request to create the product
        $response = $this->postJson('/api/products', $data);

        // Assert that the product was created
        $response->assertStatus(201)
                 ->assertJsonFragment($data);

        // Assert that the product exists in the database
        $this->assertDatabaseHas('products', $data);
    }

    /**
     * Test creating a product with invalid data.
     *
     * @return void
     */
    public function testCreateProductValidationFailure()
    {
        // Send a POST request with invalid data
        $response = $this->postJson('/api/products', [
            'name' => '', // Invalid empty string name
            'description' => '',
            'price' => 'not_a_number', // Invalid price
            'image' => 'invalid_image_url',
            'category_id' => 999, // Non-existent category
        ]);

        // Assert validation error response
        $response->assertStatus(422)
                 ->assertJsonValidationErrors([
                     'name',
                     'price',
                     'category_id',
                 ]);
    }
}
