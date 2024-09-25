<?php

namespace Tests\Feature;

use GuzzleHttp\Exception\GuzzleException;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * Test get users.
     *
     * @return void
     */
    public function test_get_users(): void // For tests I have found that snake case is easier to read
    {
        // Create a user in case the database is empty
        $this->http->post('/users', [
            'json' => [
                'name' => 'Test User',
                'email' => 'test@test.com',
            ],
        ]);

        $response = $this->http->get('/users');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getBody());
        $data = json_decode($response->getBody(), true);
        $data = $data['data'];
        $this->assertIsArray($data);
        $this->assertArrayHasKey('id', $data[0]);
    }

    /**
     * Test create user.
     *
     * @return void
     */
    public function test_create_user(): void
    {
        $response = $this->http->post('/users', [
            'json' => [
                'name' => 'Test User',
                'email' => 'test@test.com',
            ],
        ]);
        $this->assertEquals(201, $response->getStatusCode());
        $this->assertJson($response->getBody());
        $data = json_decode($response->getBody(), true);
        $data = $data['data'];
        $this->assertIsArray($data);
        $this->assertArrayHasKey('id', $data);
        $this->assertEquals('Test User', $data['name']);
    }

    /**
     * Test create user with invalid data.
     *
     * @return void
     */
    public function test_create_user_with_invalid_data(): void
    {
        try {
            $this->http->post('/users', [
                'json' => [
                    'name' => 'Test User',
                ],
            ]);
        } catch (GuzzleException $e) {
            $this->assertEquals(422, $e->getCode());
            $response = $e->getResponse();
            $this->assertJson($response->getBody());
            $data = json_decode($response->getBody(), true);
            $data = $data['errors'];
            $this->assertIsArray($data);
            $this->assertArrayHasKey('email', $data);
        }
    }

    /**
     * Test delete user.
     *
     * @return void
     */
    public function test_delete_user(): void
    {
        $response = $this->http->post('/users', [
            'json' => [
                'name' => 'Test User',
                'email' => 'test@delete.com',
            ]
        ]);

        $data = json_decode($response->getBody(), true);
        $data = $data['data'];
        $this->assertIsArray($data);
        $this->assertArrayHasKey('id', $data);

        $response = $this->http->delete('/users/' . $data['id']);
        $this->assertEquals(200, $response->getStatusCode());
    }
}