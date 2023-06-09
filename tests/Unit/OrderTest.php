<?php

namespace Tests\Unit;

use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;

class OrderTest extends TestCase
{

    use DatabaseTransactions;

    /** @test */
    public function get_order_test()
    {
        // Act
        $response = $this->get('/getOrders');

        // Assert
        $response->seeStatusCode(200);
        
    }

    /** @test */
    public function create_order_test()
    {
        // Request Data
        $data = [
            'idUser' => 1,
            'cartData' => json_encode([
                'id' => 1,
                'quan' => 10
            ]),
        ];

        // Act
        $response = $this->post('/createOrder', $data);

        // Assert
        $response->seeStatusCode(200);
    }
}
