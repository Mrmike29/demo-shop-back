<?php

namespace Tests\Unit;

use Tests\TestCase;

class ProductTest extends TestCase
{
    /** @test */
    public function get_products_test()
    {
        // Arrange
        // $data = ['id' => 1];
        $expectedResponse = ['success' => true];

        // Act
        $response = $this->get('/getProducts');

        // Assert
        $response->seeStatusCode(200)
            ->seeJsonEquals($expectedResponse);
    }
    
    /** @test */
    public function get_product_by_id_test()
    {
        // Arrange
        // $data = ['id' => 1];
        $expectedResponse = ['success' => true];

        // Act
        $response = $this->get('/getProducts?id=1');

        // Assert
        $response->seeStatusCode(200)
            ->seeJsonEquals($expectedResponse);
    }

    /** @test */
    public function create_product_test()
    {
        // Arrange
        $data = response()->json([
            'company' => 1,
            'category' => [[1]],
            'name' => 'test',
            'description' => 'test',
            'stock' => 10,
            'price' => 1,
        ]);
        $expectedResponse = ['success' => true];

        // Act
        $response = $this->post('/createProduct', $data);

        // Assert
        $response->seeStatusCode(200)
            ->seeJsonEquals($expectedResponse);
    }
}
