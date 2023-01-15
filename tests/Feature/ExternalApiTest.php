<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExternalApiTest extends TestCase
{

    use WithFaker;

    protected $user;
    protected $baseUrl = '/api/external-rest-api/';

    /**
     * Get all books
     *
     * @return void
     */
    public function test_get_all_product()
    {
        $response = $this->get($this->baseUrl);
        
        $response->assertStatus(200);
    }

    /**
     * Add product
     *
     * @return void
     */
    public function test_add_product()
    {
        $array = [
            'title' => $this->faker->word,
            'price' => 549,
            'stock' => 94,
            'rating' => 4.69,
            'description' => $this->faker->word,
            'brand' => 'Apple',
            'category' => 'smartphones',
        ];

        $response = $this->post($this->baseUrl, $array);
        
        $response->assertStatus(200);
    }

    /**
     * Update product
     *
     * @return void
     */
    public function test_update_product()
    {
        $array = [
            'title' => $this->faker->word,
            'price' => 549,
            'stock' => 94,
            'rating' => 4.69,
            'description' => $this->faker->word,
            'brand' => 'Apple',
            'category' => 'smartphones',
        ];
        
        $response = $this->patch($this->baseUrl . 1, $array);
                    
        $response->assertStatus(200);
    }

    /**
     * Delete product
     *
     * @return void
     */
    public function test_delete_product()
    {

        $response = $this->delete($this->baseUrl . 1);
                    
        $response->assertStatus(200);
    }
}
