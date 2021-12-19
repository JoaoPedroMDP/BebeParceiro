<?php
declare(strict_types=1);

namespace Tests;

use Illuminate\Testing\TestResponse;

/**
 * Trait Tools
 * @package Tests
 */
class Tools extends TestCase
{
	/**
	 * Visit the given URI with a POST request.
	 * @param string $uri
	 * @param array $data
	 * @param array $headers
	 * @return TestResponse
	 */
	public function post($uri, array $data = [], array $headers = []): TestResponse{
		$response = parent::post($uri, $data);
		$this->refreshApplication();
		return $response;
	}

	/**
	 * Visit the given URI with a GET request.
	 *
	 * @param  string  $uri
	 * @param  array  $headers
	 * @return TestResponse
	 */
	public function get($uri, array $headers = []): TestResponse
	{
		$response = parent::get($uri, $headers);
		$this->refreshApplication();
		return $response;
	}

	/**
	 * Visit the given URI with a DELETE request.
	 *
	 * @param string $uri
	 * @param array $data
	 * @return TestResponse TestResponse
	 */
	public function delete($uri, array $data = []): TestResponse
	{
		$response = parent::delete($uri, $data);
		$this->refreshApplication();
		return $response;
	}

	/**
	 * @param int $serviceNumberBefore
	 * @return void
	 */
	public function checkIfServiceNumberDecreased(int $serviceNumberBefore){
		$this->checkIfServiceNumber($serviceNumberBefore, "decreased");
	}

	/**
	 * @param int $serviceNumberBefore
	 * @return void
	 */
	public function checkIfServiceNumberIncreased(int $serviceNumberBefore){
		$this->checkIfServiceNumber($serviceNumberBefore, "increased");
	}

	/**
	 * @param int $before
	 * @param string $mode
	 * @return void
	 */
	private function checkIfServiceNumber(int $before, string $mode){
		$serviceNumberAfter = count($this->get('/service')->json());
		switch($mode){
			case "decreased":
				$number = -1;
				break;
			case "increased":
				$number = 1;
				break;
			default:
				$number = 0;
				break;
		}

		$this->assertEquals($before + $number, $serviceNumberAfter);
	}
}