<?php

namespace Tests\Unit;

use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;

class CompanyTest extends TestCase
{

    use DatabaseTransactions;

    /** @test */
    public function get_company_test()
    {
        // Act
        $response = $this->get('/getCompanies');

        // Assert
        $response->seeStatusCode(200);
        
    }

    /** @test */
    public function create_company_test()
    {
        // Request Data
        $data = [
            'country' => 1,
            'nit' => 12367543,
            'dv' => 2,
            'name' => 'Test Company',
            'address' => 'Test Address',
            'phone' => 123456789,
            'state' => 'Active'
        ];

        // Act
        $response = $this->post('/createCompany', $data);

        // Assert
        $response->seeStatusCode(200);
    }

    /** @test */
    public function delete_company_test()
    {
        // Request Data
        $data = ['id' => 1];

        // Act
        $response = $this->put('/deleteCompany', $data);

        // Assert
        $response->seeStatusCode(200);
    }
}
