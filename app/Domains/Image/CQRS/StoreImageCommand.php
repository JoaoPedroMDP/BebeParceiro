<?php
declare(strict_types=1);

namespace App\Domains\Image\CQRS;

use App\Domains\Core\CommandQuery;
use App\Domains\Core\Validates;
use Illuminate\Http\UploadedFile;

/**
 * Class StoreImageCommand
 * @package App\Domains\Image\CQRS
 */
class StoreImageCommand extends CommandQuery
{
	use Validates;
	const FIELDS = [
		'image' => [
			'rules' => ['required', 'uploadedFile']
		],
		'description' => [
			'rules' => ['required', 'string']
		],
		'path' => [
			'rules' => ['required', 'string']
		],
		'name' => [
			'rules' => ['required', 'string']
		],

	];
	/**
	 * @var UploadedFile
	 */
	public $image;

	/**
	 * @var string
	 */
	public $description;

	/**
	 * @var string
	 */
	public $path;

	/**
	 * @var string
	 */
	public $name;

	/**
	 * @param UploadedFile $image
	 * @param string $description
	 * @param string $path
	 * @param string $name
	 */
	public function __construct(UploadedFile $image, string $description, string $path, string $name)
	{
		$this->image = $image;
		$this->description = $description;
		$this->path = $path;
		$this->name = $name;
	}

	/**
	 * @param array $data
	 * @return StoreImageCommand
	 */
	public static function fromArray(array $data): StoreImageCommand
	{
		self::validate($data, self::FIELDS);

		return new self(
			$data['image'],
			$data['description'],
			$data['path'],
			$data['name']
		);
	}
}