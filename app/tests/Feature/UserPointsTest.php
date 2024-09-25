<?php

namespace Tests\Feature;

use GuzzleHttp\Exception\GuzzleException;
use Tests\TestCase;

class UserPointsTest extends TestCase
{
    /**
     * Test user earns points.
     *
     * @return void
     */
    public function test_user_earns_points(): void
    {
        $user = $this->createUser();
        $this->assertEquals(0, $user['points_balance']);

        $response = $this->http->post('/users/' . $user['id'] . '/earn', [
            'json' => [
                'points' => 100,
                'description' => 'Test points',
            ],
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getBody());
        $data = json_decode($response->getBody(), true);
        $data = $data['data'];
        $this->assertIsArray($data);
        $this->assertArrayHasKey('id', $data);
        $this->assertEquals(100, $data['points_balance']);
    }

    /**
     * Test user redeems points.
     *
     * @return void
     */
    public function test_user_redeems_points(): void
    {
        $user = $this->createUser();
        $this->assertEquals(0, $user['points_balance']);

        $response = $this->http->post('/users/' . $user['id'] . '/earn', [
            'json' => [
                'points' => 100,
                'description' => 'Test points',
            ],
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getBody());
        $data = json_decode($response->getBody(), true);
        $data = $data['data'];
        $this->assertIsArray($data);
        $this->assertArrayHasKey('id', $data);
        $this->assertEquals(100, $data['points_balance']);

        $response = $this->http->post('/users/' . $user['id'] . '/redeem', [
            'json' => [
                'points' => 50,
                'description' => 'Test redeem',
            ],
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getBody());
        $data = json_decode($response->getBody(), true);
        $data = $data['data'];
        $this->assertIsArray($data);
        $this->assertArrayHasKey('id', $data);
        $this->assertEquals(50, $data['points_balance']);
    }

    /**
     * Create a user.
     *
     * @return array
     */
    private function createUser(): array
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
        return $data['data'];
    }
}
