<?php

namespace Tests\Unit;

use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;

class CountryTest extends TestCase
{

    use DatabaseTransactions;

    /** @test */
    public function get_country_test()
    {
        // Act
        $response = $this->get('/getCountries');

        // Assert
        $response->seeStatusCode(200);
        
    }
}
