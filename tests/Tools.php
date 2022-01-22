<?php
declare(strict_types=1);

namespace Tests;

use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Testing\TestResponse;

/**
 * Trait Tools
 * @package Tests
 */
class Tools extends TestCase
{
	const TEST_IMAGES = [
		'testFiles/image1.jpg',
		'testFiles/image2.jpg',
		'testFiles/image3.jpg',
		'testFiles/image4.jpg',
		'testFiles/image5.jpg',
		'testFiles/image6.jpg',
	];

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
	 * @param array $headers
	 * @return TestResponse TestResponse
	 */
	public function delete($uri, array $data = [], array $headers = []): TestResponse
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

	/**
	 * @param string $actorName
	 * @return User
	 * @throws Exception
	 */
	public function getActor(string $actorName): User
	{
		$actor = User::where("name", '=', $actorName)->first();
		if(is_null($actor)){
			throw new Exception("Impossible to retrieve $actorName");
		}

		return $actor;
	}

	/**
	 * @param string $strToPrint
	 * @return void
	 */
	public function printDebug(string $strToPrint){
		error_log(">>>>>>>>".$strToPrint."<<<<<<<<");
	}

	/**
	 * @param TestResponse $response
	 * @param string $funcName
	 * @return void
	 * @throws Exception
	 */
	public function assertOk(TestResponse $response, string $funcName){
		try{
			$response->assertOk();
		}catch(Exception $e){
			error_log("Em $funcName\n");
			error_log($response->json());
			throw $e;
		}
	}

	/**
	 * @param int $fileIndex
	 * @param string $name
	 * @return UploadedFile
	 */
	public function getUploadedFile(int $fileIndex, string $name): UploadedFile
	{
		return new UploadedFile(resource_path(self::TEST_IMAGES[$fileIndex]), $name.'.jpg', null, null, true);
	}
}