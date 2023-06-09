<?php

namespace Tests\Unit;

use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;

class LoginTest extends TestCase
{

    use DatabaseTransactions;

    /** @test */
    public function signin_test()
    {
        // Request Data
        $data = [
            'email' => 'michaelorejuelaramirez@gmail.com',
            'password' => 'Password#1',
        ];

        // Act
        $response = $this->get('/signin');

        // Assert
        $response->seeStatusCode(200);
        
    }

    /** @test */
    public function signup_test()
    {
        // Request Data
        $data = [
            'country' => 1,
            'name' => 'Test name',
            'last_name' => 'Test last name',
            'email' => 'rtesrt@testing.com',
            'cell_phone' => 12344567,
            'password' => 'Test#1'
        ];

        // Act
        $response = $this->post('/signup', $data);

        // Assert
        $response->seeStatusCode(200);
    }
}
