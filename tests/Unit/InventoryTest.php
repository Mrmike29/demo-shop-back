<?php

namespace Tests\Unit;

use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;

class InventoryTest extends TestCase
{

    use DatabaseTransactions;

    /** @test */
    public function get_inventory_test()
    {
        // Act
        $response = $this->get('/getInventory');

        // Assert
        $response->seeStatusCode(200);
        
    }
}
