<?php
declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

/**
 * Class ServiceTest
 * @package Tests\Feature
 */
class ServiceTest extends TestCase
{
	protected $baseUrl = "localhost:8000/api/";
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_index_service()
    {
        $response = $this->get('/service');
		$response->assertOk();
    }
}
