<?php

namespace Tests\Unit;

use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;

class CategoryTest extends TestCase
{

    use DatabaseTransactions;

    /** @test */
    public function get_category_test()
    {
        // Act
        $response = $this->get('/getCategories');

        // Assert
        $response->seeStatusCode(200);
        
    }
}
