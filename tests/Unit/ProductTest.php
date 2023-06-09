<?php

namespace Tests\Unit;

use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProductTest extends TestCase
{

    use DatabaseTransactions;

    /** @test */
    public function get_products_test()
    {
        // Act
        $response = $this->get('/getProducts');

        // Assert
        $response->seeStatusCode(200);
        
    }
    
    /** @test */
    public function get_product_by_id_test()
    {
        // Act
        $response = $this->get('/getProducts?id=1');

        // Assert
        $response->seeStatusCode(200);
    }

    /** @test */
    public function create_product_test()
    {
        // Request Data
        $data = [
            'company' => 12345671,
            'category' => [[1]],
            'name' => 'test',
            'description' => 'test',
            'stock' => 10,
            'price' => 1,
        ];

        // Act
        $response = $this->post('/createProduct', $data);

        // Assert
        $response->seeStatusCode(200);
    }

    /** @test */
    public function delete_product_test()
    {
        // Request Data
        $data = ['id' => 1];

        // Act
        $response = $this->put('/deleteProduct', $data);

        // Assert
        $response->seeStatusCode(200);
    }
}
